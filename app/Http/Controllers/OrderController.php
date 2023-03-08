<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
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
        $transaction = Transaction::where('user_id', '=', Auth::user()->id)->get();
        $order = Order::where('user_id', '=', Auth::user()->id)->get();
        return view('order.waitConfirm', compact(['order', 'transaction']));
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
            'address' => "required|max:100",
            'postcode' => "required|max:5",
            'telp' => "required|max:12",
            'amount' => "required",
            'metode' => "required"
        ]);

        if ($validator->fails()) {
            return back()->with($validator->messages()->all()[0])->withInput();
        }

        $product = Product::find($id);
        $cekOrder = Order::where('user_id', '=', Auth::user()->id)->where('is_confirmed', '=', 0)->first();


        if ($product->stock <= $request->amount) {
            return redirect()->route('order.show', $product->id)->with('error', 'Jumlah Barang Yang Diminta Tidak Mencukupi');
        }

        $price = $product->price * $request->amount;

        if (empty($cekOrder)) {
            $orders = new Order();

            $postData = ['user_id' => Auth::user()->id, 'product_id' => $product->id, 'price' => $price, 'is_confirmed' => false, 'amount' => $request->amount, 'address' => $request->address, 'postcode' => $request->postcode, 'telp' => $request->telp, 'metode' => $request->metode];
            $orders->create($postData);

            if (!$orders) {
                return back()->with('error', 'Terjadi Kesalahan Saat Mengorder');
            } else {
                return redirect()->route('order.waitConfirm')->with('success', 'Order Berhasil');
            }
        }

        $newOrder = Order::where('product_id', '=', $product->id)->where('user_id', '=', Auth::user()->id)->first();
        if (empty($newOrder)) {
            $orders = new Order();

            $postData = ['user_id' => Auth::user()->id, 'product_id' => $product->id, 'price' => $price, 'is_confirmed' => false, 'amount' => $request->amount, 'address' => $request->address, 'postcode' => $request->postcode, 'telp' => $request->telp, 'metode' => $request->metode];
            $orders->create($postData);

            if (!$orders) {
                return back()->with('error', 'Terjadi Kesalahan Saat Mengorder');
            } else {
                return redirect()->route('order.waitConfirm')->with('success', 'Order Berhasil');
            }
        } else {
            $newPrice = $product->price * $request->amount;
            $newOrder->amount = $newOrder->amount + $request->amount;
            $newOrder->price = $newOrder->price + $newPrice;
            $newOrder->update();

            if (!$newOrder) {
                return back()->with('error', 'Terjadi Kesalahan Saat Mengorder');
            } else {
                return redirect()->route('order.waitConfirm')->with('success', 'Order Berhasil');
            }
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
