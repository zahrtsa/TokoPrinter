@extends('layouts.admin')
@section('title', 'Update Product')
@section('content')
    <div class="container">
        <div class="bg-white border-0 rounded-md rounded-3 p-5">
            <span class="fs-4 fw-semibold">Update Products</span>
            <hr class="mb-2">
            <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Name Product</label>
                    <input type="text" class="form-control text-capitalize" name="name" id="exampleFormControlInput1"
                        value="{{ $product->name }}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput2" class="form-label">Stock</label>
                    <input type="number" class="form-control" value="{{ $product->stock }}" name="stock"
                        id="exampleFormControlInput2">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput3" class="form-label">Price</label>
                    <input type="number" class="form-control" value="{{ $product->price }}" name="price"
                        id="exampleFormControlInput3">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                    <textarea class="form-control text-capitalize" name="desc" id="exampleFormControlTextarea1" rows="3">{{ $product->desc }}</textarea>
                </div>
                <div class="mb-3">
                    <img src="{{ url('storage') }}/{{ $product->image }}" alt="{{ $product->image }}" style="width: 12rem;">
                    <label for="exampleFormControlInput4" class="form-label d-block mt-3">Image</label>
                    <input type="file" class="form-control" value="{{ old('image') }}" name="image"
                        id="exampleFormControlInput4">
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.home') }}" class="btn me-1" id="button-sec"><i
                            class="bi bi-arrow-left"></i></a>
                    <button class="btn" id="button-prim">Update Product</button>
                </div>
            </form>
        </div>
    </div>
@endsection
