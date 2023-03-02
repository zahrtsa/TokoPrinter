<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Whistlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WhistlistController extends Controller
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
    public function store($id)
    {
        $product = Product::find($id);
        $whistlist = Whistlist::where('user_id', '=', Auth::user()->id)->where('product_id', '=',  $product->id)->first();
        if (empty($whistlist)) {
            $whistlist = new Whistlist();
            $whistlist->user_id = Auth::user()->id;
            $whistlist->product_id = $id;
            $whistlist->save();
            if ($whistlist->save()) {
                return redirect()->route('home')->with('success', 'Menambahkan Ke dalam Whistlist');
            }
        } else {
            return redirect()->route('home')->with('error', 'Anda Sudah Memasukkanya Kedalam Whistlist');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Whistlist $whistlist)
    {
        $whistlist = Whistlist::where('user_id', '=', Auth::user()->id)->get();
        return view('whistlist.index', compact(['whistlist']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Whistlist $whistlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Whistlist $whistlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Whistlist::destroy($id);
        return redirect()->route('whistlist.show')->with('success', 'Hapus Product Dari Whistlist Anda');
    }
}
