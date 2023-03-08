@extends('layouts.app')
@section('title', 'laH?shop')
@section('content')
    <div class="container">
        <div class="bg-white rounded-md rounded-3 p-5">
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
                        <th scope="col">Metode</th>
                        <th scope="col">Order At</th>
                        <th scope="col">Confirm At</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($order as $o)
                        <tr class="text-capitalize">
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ url('storage') }}/{{ \App\Models\Product::find($o->product_id)->image }}"
                                    alt="{{ $o->image }}" width="90">
                            </td>
                            <td>{{ \App\Models\Product::find($o->product_id)->name }}</td>
                            <td>{{ number_format(\App\Models\Product::find($o->product_id)->price) }}</td>
                            <td>{{ number_format($o->price) }}</td>
                            <td>{{ number_format($o->amount) }} stock</td>
                            <td>{{ $o->metode }}</td>
                            <td>{{ date('d-m-Y', strtotime($o->created_at)) }}</td>

                            @if (strtotime($o->updated_at) === strtotime($o->created_at))
                                <td> Just Waiting... </td>
                            @else
                                <td>{{ date('d-m-Y', strtotime($o->updated_at)) }}</td>
                            @endif
                            <td>
                                @if ($o->is_confirmed == 1)
                                    <span class="badge" id="button-sec">Confirmed</span>
                                @else
                                    <span class="badge bg-warning">Pendding</span>
                                @endif
                            </td>
                            <td>
                                @if ($o->is_confirmed == 1)
                                    @if ($o->metode == 'cod')
                                        <a href="#" class="btn disabled border-0" id="button-prim">Cancel</a>
                                    @else
                                        @if (count($transaction) > 0)
                                            @if (App\Models\Transaction::where('user_id', '=', Auth::user()->id)->where('order_id', '=', $o->id)->count() > 0)
                                                <a href="" class="btn disabled border-0" id="button-prim">paid</a>
                                            @else
                                                <a href="" class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdrop">Pay</a>
                                            @endif
                                        @else
                                            <a href="" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop">Pay</a>
                                        @endif
                                    @endif
                                @else
                                    <a href="{{ route('order.destroy', $o->id) }}" class="btn btn-danger">Cancel</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <div class="card p-4 m-3">
                            Tidak Ada Product Yang Anda Checkout...
                        </div>
                    @endforelse
                </tbody>
            </table>
            <a href="{{ route('home') }}" class="btn" id="button-prim"><i class="bi bi-arrow-left"></i></a>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="bg-white rounded-3 modal-dialog">
            <form action="{{ route('transaction.store', $o->id) }}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-uppercase" id="staticBackdropLabel">Pembayaran Melalui
                            {{ $o->metode }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleFormControlInput3" class="form-label me-2">No_Rekening
                                {{ $o->metode }}</label>
                            <input type="number" class="form-control bg-transparent" name="no_rekening"
                                id="exampleFormControlInput3" placeholder="Your Rekening Number" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput3" class="form-label me-2"> Total:
                                <span id="button-sec" class="p-1 rounded-md rounded-3 px-2">{{ number_format($o->price) }}
                                    IDR</span></label>
                            <input type="number" class="form-control bg-transparent" name="price"
                                id="exampleFormControlInput3" placeholder="Amount To Be Paid" required>
                        </div>
                    </div>
                    <div class="mt-1 p-3 text-end">
                        <button type="button" class="btn" id="button-prim" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn" id="button-sec">Pay</button>
                    </div>
            </form>
        </div>
    </div>
@endsection
