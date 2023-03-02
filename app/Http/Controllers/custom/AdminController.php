<?php

namespace App\Http\Controllers\custom;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.index', compact(['products']));
    }

    public function show()
    {
        $order = Order::all();
        return view('admin.order.index', compact(['order']));
    }
    public function confirm($id)
    {
        $order = Order::find($id);
        $order->is_confirmed = true;
        $order->save();
        return redirect()->route('orderAdmin.show')->with('success', 'Pesanan Dikonfirmasi');
    }
    public function cancel($id)
    {
        $order = Order::find($id);
        $order->is_confirmed = false;
        $order->save();
        return redirect()->route('orderAdmin.show')->with('success', 'Pesanan Dikonfirmasi');
    }
}
