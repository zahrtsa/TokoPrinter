@extends('layouts.app')
@section('title', 'Order Product')
@section('content')
    <div class="container">
        <div class="bg-white rounded-md rounded-3 p-5">
            <img src="{{ url('storage') }}/{{ $product->image }}" alt="">
            <p class="fw-semibold fs-3">{{ $product->name }}</p>
            <span class="text-danger">{{ number_format($product->price) }} IDR</span>
            <hr class="mb-2">
            <form action="{{ route('order.store', $product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput3" class="form-label me-2">Amount</label><span id="button-sec"
                        class="px-2 rounded-3">{{ $product->stock }} Stock</span>
                    <input type="number" class="form-control" name="amount" id="exampleFormControlInput3" required>
                </div>
                <div class="mt-4">
                    <a href="{{ route('home') }}" class="btn me-1" id="button-sec"><i class="bi bi-arrow-left"></i></a>
                    <button class="btn" id="button-prim">Order Product</button>
                </div>
            </form>
        </div>
    </div>
@endsection
