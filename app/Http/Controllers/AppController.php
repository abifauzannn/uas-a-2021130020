<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        $totalMenu = Menu::count();
        $totalOrder = Order::count();

        return view('index', compact('totalMenu', 'totalOrder'));
    }
}
