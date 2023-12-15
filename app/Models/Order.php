<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'status',
        // Add other fillable attributes here if needed
    ];

    public function orderMenus()
    {
        return $this->hasMany(OrderMenu::class);
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'order_menus')->withPivot('quantity');
    }
}
