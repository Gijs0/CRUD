<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'festival_id',
        'type',
        'description',
        'price',
        'quantity_available',
        'quantity_sold',
        'sale_start_date',
        'sale_end_date',
        'is_active'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'sale_start_date' => 'datetime',
        'sale_end_date' => 'datetime',
        'is_active' => 'boolean'
    ];

    public function festival()
    {
        return $this->belongsTo(Festival::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getRemainingQuantityAttribute()
    {
        return $this->quantity_available - $this->quantity_sold;
    }

    public function getIsAvailableAttribute()
    {
        $isActive = $this->is_active;
        $hasRemaining = $this->remaining_quantity > 0;
        $isInSalePeriod = $this->sale_start_date <= now() && $this->sale_end_date >= now();
        
        Log::info('Ticket availability check', [
            'ticket_id' => $this->id,
            'is_active' => $isActive,
            'quantity_available' => $this->quantity_available,
            'quantity_sold' => $this->quantity_sold,
            'remaining_quantity' => $this->remaining_quantity,
            'sale_start_date' => $this->sale_start_date,
            'sale_end_date' => $this->sale_end_date,
            'current_time' => now(),
            'is_in_sale_period' => $isInSalePeriod,
            'final_availability' => $isActive && $hasRemaining && $isInSalePeriod
        ]);

        // Als er tickets beschikbaar zijn, beschouw het ticket als beschikbaar
        return $hasRemaining;
    }
} 