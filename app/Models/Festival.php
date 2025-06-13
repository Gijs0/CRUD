<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Festival extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'location',
        'start_date',
        'end_date',
        'image',
        'banner_image',
        'base_price',
        'capacity',
        'tickets_sold',
        'is_active'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'base_price' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function getAvailableTicketsAttribute()
    {
        return $this->capacity - $this->tickets_sold;
    }

    public function getIsSoldOutAttribute()
    {
        return $this->tickets_sold >= $this->capacity;
    }

    public function getActiveTicketsAttribute()
    {
        return $this->tickets()->where('is_active', true)
            ->where('sale_start_date', '<=', now())
            ->where('sale_end_date', '>=', now())
            ->where('quantity_available', '>', 0)
            ->get();
    }
} 