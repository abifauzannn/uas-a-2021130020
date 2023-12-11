<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    protected $primaryKey = 'id';
    protected $casts = [
        'id' => 'string',
    ];
    public $increment = false;
    protected $fillable = ['id','nama', 'rekomendasi', 'harga', 'kategori'];

    public function orderMenus()
    {
        return $this->hasMany(OrderMenu::class);
    }
}
