@extends('layouts.app')
@section('title', 'Order Product')
@section('content')
    <div class="container">
        <div class="bg-white rounded-md rounded-3 p-5">
            <img src="{{ url('storage') }}/{{ $product->image }}" alt="{{ $product->image }}" width="200">
            <p class="fw-semibold fs-3">{{ $product->name }}</p>
            <span class="text-danger">{{ number_format($product->price) }} IDR</span>
            <p>{{ $product->desc }}</p>
            <hr class="mb-2">
            <form action="{{ route('order.store', $product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="mb-3">
                    <label for="exampleFormControlInput3" class="form-label me-2">Address</label>
                    <input type="type" class="form-control text-capitalize" name="address" id="exampleFormControlInput3"
                        required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput3" class="form-label me-2">Postcode</label>
                    <input type="number" class="form-control" name="postcode" id="exampleFormControlInput3" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput3" class="form-label me-2">Amount</label><span id="button-sec"
                        class="px-2 rounded-3">{{ $product->stock }} Stock</span>
                    <input type="number" class="form-control" name="amount" id="exampleFormControlInput3" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput3" class="form-label me-2">Telp</label>
                    <input type="number" class="form-control" name="telp" id="exampleFormControlInput3" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput3" class="form-label me-2">Metode Pembayaran</label>
                    <select class="form-select" aria-label="Default select example" name="metode">
                        <option selected disabled>Pilih Metode..</option>
                        <option value="cod">COD</option>
                        <option value="bca">BCA</option>
                        <option value="bni">BNI</option>
                        <option value="bri">BRI</option>
                    </select>
                </div>

                <div class="mt-4">
                    <a href="{{ route('home') }}" class="btn me-1" id="button-sec"><i class="bi bi-arrow-left"></i></a>
                    <button class="btn" id="button-prim">Order Product</button>
                </div>
            </form>
        </div>
    </div>
@endsection
