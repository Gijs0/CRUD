<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        Log::info('Cart contents in index:', ['cart' => $cart]);
        
        $items = [];
        $total = 0;

        foreach ($cart as $id => $details) {
            if (!is_array($details)) {
                continue;
            }

            $ticket = Ticket::find($id);
            if ($ticket && $ticket->is_available) {
                $items[] = [
                    'id' => $ticket->id,
                    'name' => $details['name'],
                    'price' => $details['price'],
                    'quantity' => $details['quantity']
                ];
                $total += $details['price'] * $details['quantity'];
            }
        }

        return view('cart.index', compact('items', 'total'));
    }

    public function add(Request $request, Ticket $ticket)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);
        
        if (!$ticket->is_available) {
            return back()->with('error', 'Deze tickets zijn niet meer beschikbaar.');
        }

        if ($request->quantity > $ticket->remaining_quantity) {
            return back()->with('error', 'Er zijn niet genoeg tickets beschikbaar.');
        }

        $cart = Session::get('cart', []);
        $cart[$ticket->id] = [
            'name' => $ticket->festival->name . ' - ' . $ticket->type,
            'price' => $ticket->price,
            'quantity' => $request->quantity
        ];
        Session::put('cart', $cart);
        Log::info('Added ticket to cart:', ['ticket_id' => $ticket->id, 'quantity' => $request->quantity, 'cart' => $cart]);

        return back()->with('success', 'Tickets toegevoegd aan winkelwagen.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0'
        ]);

        $ticket = Ticket::findOrFail($id);
        
        if ($request->quantity > $ticket->remaining_quantity) {
            return back()->with('error', 'Er zijn niet genoeg tickets beschikbaar.');
        }

        $cart = Session::get('cart', []);
        
        if ($request->quantity == 0) {
            unset($cart[$id]);
        } else {
            $cart[$id] = [
                'name' => $ticket->festival->name . ' - ' . $ticket->type,
                'price' => $ticket->price,
                'quantity' => $request->quantity
            ];
        }
        
        Session::put('cart', $cart);
        Log::info('Updated cart:', ['cart' => $cart]);

        return back()->with('success', 'Winkelwagen bijgewerkt.');
    }

    public function remove($id)
    {
        $cart = Session::get('cart', []);
        unset($cart[$id]);
        Session::put('cart', $cart);
        Log::info('Removed ticket from cart:', ['ticket_id' => $id, 'cart' => $cart]);

        return back()->with('success', 'Ticket verwijderd uit winkelwagen.');
    }

    public function clear()
    {
        Session::forget('cart');
        Log::info('Cart cleared');
        return back()->with('success', 'Winkelwagen leeggemaakt.');
    }
} 