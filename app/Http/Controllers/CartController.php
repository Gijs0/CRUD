<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        $items = [];
        $total = 0;

        foreach ($cart as $id => $quantity) {
            $ticket = Ticket::find($id);
            if ($ticket && $ticket->isAvailable()) {
                $items[] = [
                    'id' => $ticket->id,
                    'name' => $ticket->festival->name . ' - ' . $ticket->type,
                    'price' => $ticket->price,
                    'quantity' => $quantity,
                    'subtotal' => $ticket->price * $quantity
                ];
                $total += $ticket->price * $quantity;
            }
        }

        return view('cart.index', compact('items', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $ticket = Ticket::findOrFail($request->ticket_id);
        
        if (!$ticket->isAvailable()) {
            return back()->with('error', 'Deze tickets zijn niet meer beschikbaar.');
        }

        if ($request->quantity > $ticket->remainingQuantity()) {
            return back()->with('error', 'Er zijn niet genoeg tickets beschikbaar.');
        }

        $cart = Session::get('cart', []);
        $cart[$ticket->id] = ($cart[$ticket->id] ?? 0) + $request->quantity;
        Session::put('cart', $cart);

        return back()->with('success', 'Tickets toegevoegd aan winkelwagen.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0'
        ]);

        $ticket = Ticket::findOrFail($id);
        
        if ($request->quantity > $ticket->remainingQuantity()) {
            return back()->with('error', 'Er zijn niet genoeg tickets beschikbaar.');
        }

        $cart = Session::get('cart', []);
        
        if ($request->quantity == 0) {
            unset($cart[$id]);
        } else {
            $cart[$id] = $request->quantity;
        }
        
        Session::put('cart', $cart);

        return back()->with('success', 'Winkelwagen bijgewerkt.');
    }

    public function remove($id)
    {
        $cart = Session::get('cart', []);
        unset($cart[$id]);
        Session::put('cart', $cart);

        return back()->with('success', 'Ticket verwijderd uit winkelwagen.');
    }

    public function clear()
    {
        Session::forget('cart');
        return back()->with('success', 'Winkelwagen leeggemaakt.');
    }
} 