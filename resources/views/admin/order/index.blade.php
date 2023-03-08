@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="bg-white border-0 rounded-md rounded-3 p-5">
            <p class="fw-semibold fs-4">Products Confirm</p>
            <hr class="mb-2">
            <table class="table" id="table_id">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Client Name</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Price / Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Order At</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order as $o)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ App\Models\User::find($o->user_id)->name }}</td>
                            <td>{{ App\Models\Product::find($o->product_id)->name }}</td>
                            <td>Rp. {{ number_format(App\Models\Product::find($o->product_id)->price) }}</td>
                            <td>Rp. {{ number_format($o->price) }}</td>
                            <td>{{ number_format($o->amount) }} Stock</td>
                            <td>{{ date('d-m-Y', strtotime($o->created_at)) }}</td>
                            <td>
                                @if ($o->is_confirmed == 1)
                                    <span class="badge" id="button-sec">Confirmed</span>
                                @else
                                    <span class="badge bg-warning">Pendding</span>
                                @endif
                            </td>
                            <td>
                                @if ($o->is_confirmed == 0)
                                    <a href="{{ route('orderAdmin.confirm', $o->id) }}" class="btn"
                                        id="button-sec">Confirm
                                    </a>
                                @else
                                    <a href="{{ route('orderAdmin.cancel', $o->id) }}"
                                        class="btn btn-danger">Unconfirmed</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
