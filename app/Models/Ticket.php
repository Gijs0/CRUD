<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->is_active 
            && $this->remaining_quantity > 0
            && $this->sale_start_date <= now()
            && $this->sale_end_date >= now();
    }
} 