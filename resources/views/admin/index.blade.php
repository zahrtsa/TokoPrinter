@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
    <div class="container">
        <div class="bg-white border-0 rounded-md rounded-3 p-5">
            <p class="fw-semibold fs-4">Products</p>
            <hr class="mb-2">
            <a href="{{ route('product.create') }}" class="btn mb-3" id="button-sec">Add product</a>
            <table class="table table-hover display" id="table_id">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Image</th>
                        <th scope="col">NameProduct</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Price</th>
                        <th scope="col">Desc</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $p)
                        <tr class="text-capitalize">
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ url('storage') }}/{{ $p->image }}" alt="{{ $p->image }}"
                                    width="90">
                            </td>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->stock }}</td>
                            <td>{{ number_format($p->price) }}</td>
                            <td>{{ $p->desc }}</td>
                            <td>
                                <a href="{{ route('product.edit', $p->id) }}" class="btn" id="button-prim"><i
                                        class="bi bi-pen"></i></a>
                                <a href="{{ route('product.destroy', $p->id) }}" class="btn btnDelete" id="button-sec"><i
                                        class="bi bi-trash2"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
