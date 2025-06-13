<?php

namespace Database\Seeders;

use App\Models\Festival;
use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        $festivals = Festival::all();

        foreach ($festivals as $festival) {
            // Regular ticket
            Ticket::create([
                'festival_id' => $festival->id,
                'type' => 'Regular',
                'description' => 'Standaard festival ticket met toegang tot alle activiteiten.',
                'price' => $festival->base_price,
                'quantity_available' => $festival->capacity * 0.7,
                'quantity_sold' => 0,
                'sale_start_date' => now(),
                'sale_end_date' => $festival->start_date->subDay(),
                'is_active' => true,
            ]);

            // VIP ticket
            Ticket::create([
                'festival_id' => $festival->id,
                'type' => 'VIP',
                'description' => 'VIP ticket met exclusieve toegang tot VIP-gebieden, gratis drankjes en speciale activiteiten.',
                'price' => $festival->base_price * 2,
                'quantity_available' => $festival->capacity * 0.2,
                'quantity_sold' => 0,
                'sale_start_date' => now(),
                'sale_end_date' => $festival->start_date->subDay(),
                'is_active' => true,
            ]);

            // Early Bird ticket
            Ticket::create([
                'festival_id' => $festival->id,
                'type' => 'Early Bird',
                'description' => 'Voordelig festival ticket voor vroege vogels. Beperkt aantal beschikbaar!',
                'price' => $festival->base_price * 0.8,
                'quantity_available' => $festival->capacity * 0.1,
                'quantity_sold' => 0,
                'sale_start_date' => now(),
                'sale_end_date' => now()->addMonth(),
                'is_active' => true,
            ]);
        }
    }
} 