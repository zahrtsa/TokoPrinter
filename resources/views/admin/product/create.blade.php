@extends('layouts.admin')
@section('title', 'Create Product')
@section('content')
    <div class="container">
        <div class="bg-white border-0 rounded-md rounded-3 p-5">
            <span class="fs-4 fw-semibold"> Create Products</span>
            <hr class="mb-2">
            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Name Product</label>
                    <input type="text" class="form-control text-capitalize" name="name" id="exampleFormControlInput1"
                        required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput2" class="form-label">Stock</label>
                    <input type="number" class="form-control" name="stock" id="exampleFormControlInput2" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput3" class="form-label">Price</label>
                    <input type="number" class="form-control" name="price" id="exampleFormControlInput3" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                    <textarea class="form-control text-capitalize" name="desc" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput4" class="form-label">Image</label>
                    <input type="file" class="form-control" name="image" id="exampleFormControlInput4" required>
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.home') }}" class="btn me-1" id="button-sec"><i
                            class="bi bi-arrow-left"></i></a>
                    <button class="btn" id="button-prim">Create Product</button>
                </div>
            </form>
        </div>
    </div>
@endsection
