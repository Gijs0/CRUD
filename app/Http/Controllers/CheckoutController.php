<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CheckoutController extends Controller
{
    public function index(): View
    {
        $cart = Session::get('cart', []);
        $total = 0;

        foreach ($cart as $details) {
            if (is_array($details)) {
                $total += floatval($details['price']) * intval($details['quantity']);
            }
        }

        return view('checkout.index', compact('total'));
    }

    public function process(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string'
        ]);

        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return back()->with('error', 'Je winkelwagen is leeg.');
        }

        try {
            DB::beginTransaction();

            // Create the order
            $order = Order::create([
                'user_id' => Auth::id(),
                'customer_name' => $validated['customer_name'],
                'customer_email' => $validated['customer_email'],
                'customer_phone' => $validated['customer_phone'],
                'shipping_address' => $validated['shipping_address'],
                'status' => 'pending',
                'total_amount' => 0 // Will be updated after adding items
            ]);

            $totalAmount = 0;

            // Process each item in the cart
            foreach ($cart as $ticketId => $details) {
                if (!is_array($details)) {
                    continue;
                }

                $ticket = Ticket::findOrFail($ticketId);
                $quantity = intval($details['quantity']);

                // Check if ticket is still available
                if (!$ticket->is_available || $ticket->remaining_quantity < $quantity) {
                    throw new \Exception("Ticket {$ticket->type} is niet meer beschikbaar in de gevraagde hoeveelheid.");
                }

                // Create order item
                $order->items()->create([
                    'ticket_id' => $ticket->id,
                    'quantity' => $quantity,
                    'price' => floatval($details['price']),
                    'ticket_code' => strtoupper(uniqid('TICKET-'))
                ]);

                // Update ticket quantities
                $ticket->increment('quantity_sold', $quantity);

                $totalAmount += floatval($details['price']) * $quantity;
            }

            // Update order total
            $order->update(['total_amount' => $totalAmount]);

            // Clear the cart
            Session::forget('cart');

            DB::commit();

            return redirect()->route('orders.show', $order)
                ->with('success', 'Je bestelling is succesvol geplaatst! Je tickets zijn verzonden naar je e-mailadres.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Er is een fout opgetreden: ' . $e->getMessage());
        }
    }
} 