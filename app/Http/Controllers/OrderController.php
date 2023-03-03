<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = Order::where('user_id', '=', Auth::user()->id)->get();
        return view('order.waitConfirm', compact(['order']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'amount' => "required",
        ]);
        if ($validator->fails()) {
            return back()->with($validator->messages()->all()[0])->withInput();
        }

        $product = Product::find($id);
        $newStock = $product->stock - $request->amount;

        if ($newStock <= 0) {
            return redirect()->route('order.show', $product->id)->with('error', 'Jumlah Barang Yang Diminta Tidak Mencukupi');
        }

        $price = $product->price * $request->amount;
        $orders = new Order();

        $postData = ['user_id' => Auth::user()->id, 'product_id' => $product->id, 'price' => $price, 'is_confirmed' => false, 'amount' => $request->amount];
        $orders->create($postData);

        $product->stock = $newStock;
        $product->update();

        if (!$orders) {
            return back()->with('error', 'Terjadi Kesalahan Saat Mengorder');
        } else {
            return redirect()->route('order.waitConfirm')->with('success', 'Order Berhasil');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order, $id)
    {
        $product = Product::find($id);
        $order = Order::find($id);
        return view('order.index', compact(['product', 'order']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Order::destroy($id);
        return redirect()->route('order.waitConfirm')->with('success', 'Berhasil Cancel Order');
    }
}
