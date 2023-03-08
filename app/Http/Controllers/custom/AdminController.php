<?php

namespace App\Http\Controllers\custom;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Transaction;
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
    public function confirm(Request $request, $id)
    {
        $order = Order::find($id);
        $order->is_confirmed = true;
        $order->save();

        //$cart = User::findOrfail($id);

        //$product = Product::findOrFail($order->id);
        $product = Product::find($order->product_id);
        $newStock = $product->stock - $order->amount;
        $product->stock = $newStock;
        $product->save();


        // $product->update();
        return redirect()->route('orderAdmin.show')->with('success', 'Pesanan Dikonfirmasi');

    }
    public function cancel($id)
    {
        $order = Order::find($id);
        $order->is_confirmed = false;
        $order->save();
        return redirect()->route('orderAdmin.show')->with('success', 'Pesanan Unkonfirmasi');
    }
    public function transactionshow()
    {
        $transaction = Transaction::all();
        return view('admin.transaction.index', compact(['transaction']));
    }
}
