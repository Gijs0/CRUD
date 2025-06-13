<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    public function index(Festival $festival)
    {
        $tickets = $festival->tickets()
            ->where('is_active', true)
            ->where('sale_start_date', '<=', now())
            ->where('sale_end_date', '>=', now())
            ->where('quantity_available', '>', 0)
            ->get();

        return view('tickets.index', compact('festival', 'tickets'));
    }

    public function create(Festival $festival)
    {
        $this->authorize('create', [Ticket::class, $festival]);
        return view('tickets.create', compact('festival'));
    }

    public function store(Request $request, Festival $festival)
    {
        $this->authorize('create', [Ticket::class, $festival]);

        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'quantity_available' => 'required|integer|min:1',
            'sale_start_date' => 'required|date|after:now',
            'sale_end_date' => 'required|date|after:sale_start_date|before:' . $festival->start_date,
        ]);

        $validated['festival_id'] = $festival->id;
        $validated['is_active'] = true;

        $ticket = Ticket::create($validated);

        return redirect()->route('festivals.show', $festival)
            ->with('success', 'Ticket type succesvol toegevoegd!');
    }

    public function edit(Festival $festival, Ticket $ticket)
    {
        $this->authorize('update', $ticket);
        return view('tickets.edit', compact('festival', 'ticket'));
    }

    public function update(Request $request, Festival $festival, Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'quantity_available' => 'required|integer|min:' . $ticket->quantity_sold,
            'sale_start_date' => 'required|date',
            'sale_end_date' => 'required|date|after:sale_start_date|before:' . $festival->start_date,
            'is_active' => 'boolean'
        ]);

        $ticket->update($validated);

        return redirect()->route('festivals.show', $festival)
            ->with('success', 'Ticket type succesvol bijgewerkt!');
    }

    public function destroy(Festival $festival, Ticket $ticket)
    {
        $this->authorize('delete', $ticket);

        if ($ticket->quantity_sold > 0) {
            return back()->with('error', 'Kan ticket type niet verwijderen omdat er al tickets zijn verkocht.');
        }

        $ticket->delete();

        return redirect()->route('festivals.show', $festival)
            ->with('success', 'Ticket type succesvol verwijderd!');
    }
}
