@extends('layouts.app')
@section('title', 'laH?shop')
@section('content')
    <div class="container">
        <div class="row flex-wrap">
            <div class="p-3 mb-2 rounded-3 rounded-md " id="button-sec">
                Whistlist Anda....
            </div>
            @forelse ($whistlist as $w)
                <div class="card col-sm-3 border-0 m-1 p-0 rounded-3">
                    <div class="p-0">
                        <img src="{{ url('storage') }}/{{ $w->product->image }}" class="card-img-top w-100 rounded-3"
                            alt="..." style="min-height: 180px;">
                    </div>
                    <div class="card-body">
                        <hr>
                        <h5 class="card-title fw-semibold">{{ $w->product->name }}</h5>
                        <div class="d-flex">
                            <span class="card-text me-2 text-danger">{{ number_format($w->product->price) }} IDR</span>
                            <span class="px-3 py-0 rounded-3 rounded-md" id="button-prim">{{ $w->product->stock }}
                                Stock</span>

                        </div>
                        <p class="card-text mt-1">{{ $w->product->desc }}</p>
                        <div class="d-flex">
                            <a href="{{ route('whistlist.destroy', $w->id) }}"
                                class="p-2 me-1 rounded-md rounded-3 text-decoration-none" id="button-prim"><i
                                    class="bi bi-trash px-2"></i></a>
                            <a href="{{ route('order.store', $w->id) }}"
                                class="p-2 rounded-md rounded-3 text-decoration-none" id="button-sec"><i
                                    class="bi bi-cart me-2"></i>Pesan
                                Sekarang</a>

                        </div>
                    </div>
                </div>
            @empty
                <div class="card border-0 m-1 p-0 rounded-3 p-3">
                    Tidak Ada Product Yang Anda Masukkan Ke Dalam Whislist..
                </div>
            @endforelse
        </div>
    </div>
@endsection
