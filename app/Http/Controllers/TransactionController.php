<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $order = Order::find($id);
        $transaction = new Transaction();

        if ($request->price < $order->price) {
            return back()->with('error', 'Masukkan Nominal Yang Sesuai');
        }

        $transaction->user_id = Auth::user()->id;
        $transaction->order_id = $order->id;
        $transaction->no_rekening = Hash::make($request->no_rekening);
        $transaction->price = $request->price;
        $transaction->status = true;
        $transaction->save();
        if (!$transaction) {
            return back()->with('error', 'Gagal Membayar');
        } else {
            return redirect()->route('order.waitConfirm')->with('success', 'Pembayaran Berhasil!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
