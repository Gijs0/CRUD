<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Ticket;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Order::class, 'order');
    }

    /**
     * Display a listing of the orders.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $orders = Auth::user()->orders()->latest()->get();
        return view('orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\View\View
     */
    public function show(Order $order): View
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Store a newly created order in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
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
                $quantity = $details['quantity'] ?? 0;

                // Check if ticket is still available
                if (!$ticket->is_available || $ticket->remaining_quantity < $quantity) {
                    throw new \Exception("Ticket {$ticket->type} is niet meer beschikbaar in de gevraagde hoeveelheid.");
                }

                // Create order item
                $order->items()->create([
                    'ticket_id' => $ticket->id,
                    'quantity' => $quantity,
                    'price' => $ticket->price,
                    'ticket_code' => strtoupper(uniqid('TICKET-'))
                ]);

                // Update ticket quantities
                $ticket->increment('quantity_sold', $quantity);

                $totalAmount += $ticket->price * $quantity;
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

    /**
     * Update the specified order in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order->update($validated);

        return back()->with('success', 'Order status updated successfully!');
    }

    /**
     * Show the form for creating a new order.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function create(): View|RedirectResponse
    {
        // Debug logging
        Log::info('Starting order creation process');
        
        // Get cart from session
        $cart = Session::get('cart', []);
        Log::info('Cart contents:', ['cart' => $cart]);
        
        if (empty($cart)) {
            Log::warning('Cart is empty');
            return redirect()->route('cart.index')
                ->with('error', 'Je winkelwagen is leeg. Voeg eerst tickets toe aan je winkelwagen.');
        }

        // Initialize items array
        $items = [];
        $total = 0;

        // Process each item in the cart
        foreach ($cart as $id => $details) {
            if (!is_array($details)) {
                continue;
            }

            $ticket = Ticket::find($id);
            if ($ticket && $ticket->is_available) {
                $items[] = [
                    'id' => $ticket->id,
                    'name' => $details['name'],
                    'price' => floatval($details['price']),
                    'quantity' => intval($details['quantity'])
                ];
                $total += floatval($details['price']) * intval($details['quantity']);
                Log::info('Added item to order:', ['item' => $items[count($items) - 1]]);
            } else {
                Log::warning('Ticket not found or not available:', ['id' => $id]);
            }
        }

        if (empty($items)) {
            Log::warning('No available items found in cart');
            return redirect()->route('cart.index')
                ->with('error', 'Er zijn geen beschikbare tickets in je winkelwagen.');
        }

        Log::info('Order creation view rendered', ['items_count' => count($items), 'total' => $total]);
        return view('orders.create', compact('items', 'total'));
    }
}