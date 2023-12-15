<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderMenu;

class OrderController extends Controller
{

    public function orderList()
    {
        $orders = Order::all();
        return view('orders.list', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('menus')->find($id);

        // Check if the order exists
        if (!$order) {
            return abort(404, 'Order not found');
        }

        return view('orders.detail', compact('order'));
    }
    public function order()
    {
        $menus = Menu::all();
        return view('order', compact('menus'));
    }

    public function createOrder(Request $request)
{
    $validated = $request->validate([
        'status' => 'required|string',
        'menu' => 'required|array',
    ]);

    // Create a new order
    $order = Order::create([
        'status' => $validated['status'],
    ]);

    // Calculate total price and create order menus
    $totalPrice = 0;

    foreach ($validated['menu'] as $menuId => $menuData) {
        // Check if the menu is selected
        if (isset($menuData['quantity']) && $menuData['quantity'] > 0) {
            $menu = Menu::findOrFail($menuId);
            $quantity = $menuData['quantity'];

            // Apply discount for recommended menus
            $discount = $menu->rekomendasi ? 0.1 : 0;

            // Calculate menu price
            $menuPrice = $menu->harga * (1 - $discount);

            // Create order menu
            OrderMenu::create([
                'order_id' => $order->id,
                'menu_id' => $menu->id,
                'quantity' => $quantity,
            ]);

            // Update total price
        }
    }

    // Save the calculated total price to the order
    $order->save();

    return redirect()->route('index')->with('success', 'Order created successfully.');
}
}
