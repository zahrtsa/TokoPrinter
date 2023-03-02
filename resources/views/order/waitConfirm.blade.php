@extends('layouts.app')
@section('title', 'Your Orders')
@section('content')
    <div class="container">
        <div class="bg-white shadow-lg rounded-md rounded-3 p-5">
            <p class="fw-semibold fs-4">Products Order</p>
            <hr class="mb-2">
            <table class="table table-hover display" id="table_id">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Image</th>
                        <th scope="col">NameProduct</th>
                        <th scope="col">Price / Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Order At</th>
                        <th scope="col">Confirm At</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order as $o)
                        <tr class="text-capitalize">
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ url('storage') }}/{{ \App\Models\Product::find($o->product_id)->image }}"
                                    alt="{{ $o->image }}" width="90">
                            </td>
                            <td>{{ \App\Models\Product::find($o->product_id)->name }}</td>
                            <td>{{ number_format(\App\Models\Product::find($o->product_id)->price) }}</td>
                            <td>{{ number_format($o->price) }}</td>
                            <td>{{ $o->amount }}</td>
                            <td>{{ date('d-m-Y', strtotime($o->created_at)) }}</td>

                            @if (strtotime($o->updated_at) === strtotime($o->created_at))
                                <td> Just Waiting... </td>
                            @else
                                <td>{{ date('d-m-Y', strtotime($o->updated_at)) }}</td>
                            @endif
                            <td>
                                @if ($o->is_confirmed == 1)
                                    <span class="badge bg-success">Confirmed</span>
                                @else
                                    <span class="badge bg-warning">Pendding</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('home') }}" class="btn" id="button-prim"><i class="bi bi-arrow-left"></i></a>
        </div>
    </div>
@endsection
