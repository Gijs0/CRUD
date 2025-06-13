<?php

namespace Database\Seeders;

use App\Models\Festival;
use Illuminate\Database\Seeder;

class FestivalSeeder extends Seeder
{
    public function run(): void
    {
        $festivals = [
            [
                'name' => 'Summer Vibes Festival',
                'description' => 'Een geweldig zomerfestival met de beste artiesten van het moment. Geniet van muziek, eten en drank in een prachtige omgeving.',
                'location' => 'Amsterdam',
                'start_date' => now()->addMonths(2),
                'end_date' => now()->addMonths(2)->addDays(3),
                'base_price' => 89.99,
                'capacity' => 50000,
                'is_active' => true,
            ],
            [
                'name' => 'Winter Wonderland',
                'description' => 'Een magisch winterfestival met ijsbeelden, warme drankjes en live muziek. Perfect voor de feestdagen!',
                'location' => 'Rotterdam',
                'start_date' => now()->addMonths(6),
                'end_date' => now()->addMonths(6)->addDays(2),
                'base_price' => 69.99,
                'capacity' => 30000,
                'is_active' => true,
            ],
            [
                'name' => 'Spring Break Festival',
                'description' => 'Welkom de lente met dit vrolijke festival vol muziek, dans en kleurrijke activiteiten.',
                'location' => 'Utrecht',
                'start_date' => now()->addMonths(9),
                'end_date' => now()->addMonths(9)->addDays(2),
                'base_price' => 79.99,
                'capacity' => 40000,
                'is_active' => true,
            ],
        ];

        foreach ($festivals as $festival) {
            Festival::create($festival);
        }
    }
} 