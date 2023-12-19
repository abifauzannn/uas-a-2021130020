<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMenu extends Model
{
    protected $fillable = [
        'order_id', // Add 'order_id' to the fillable attributes
        'menu_id',
        'quantity',
        // Add other fillable attributes here if needed
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    // Relationship to Order (Many-to-One)

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
