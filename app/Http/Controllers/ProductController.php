<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\returnSelf;

class ProductController extends Controller
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
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = new \App\Models\Product;
        $validator = Validator::make($request->all(), [
            "name" => "required|max:255",
            "stock" => "required",
            "price" => "required",
            "desc" => "required|max:255",
            "image" => "required|mimes:jpeg,png,jpg|image",
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0])->withInput();
        }
        $image_path = $request->file('image')->store('image', 'public');
        $postData = ['name' => $request->name, 'stock' => $request->stock, 'price' => $request->price, 'desc' => $request->desc, 'image' => $image_path];
        $product->create($postData);
        if (!$product) {
            return back()->with('error', 'Gagal Menambahkan Data Product');
        } else {
            return redirect()->route('admin.home')->with('success', 'Berhasil Menambahkan Data Product');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product, $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.product.update', compact(['product']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $validator = Validator::make($request->all(), [
            "name" => "required|max:255",
            "stock" => "required",
            "price" => "required",
            "desc" => "required|max:255",
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0])->withInput();
        };
        if ($request->hasFile('image')) {
            if (file_exists($product->image)) {
                File::delete($product->image);
            }
            $image_path =  $request->file('image')->store('image', 'public');
        } else {
            $image_path = $product->image;
        }
        $postData = ['name' => $request->name, 'stock' => $request->stock, 'price' => $request->price, 'desc' => $request->desc, 'image' => $image_path];
        $product->update($postData);
        if (!$product) {
            return back()->with('error', 'Gagal Menambahkan Data Product');
        } else {
            return redirect()->route('admin.home')->with('success', 'Berhasil Menambahkan Data Product');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, $id)
    {
        Product::destroy($id);
        return redirect()->route('admin.home')->with('delete', 'Data Berhasil Dihapus');
    }
}
