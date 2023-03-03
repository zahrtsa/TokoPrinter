@extends('layouts.app')
@section('title', 'laH?shop')
@section('content')
    <div class="container">
        <div class="row flex-wrap">
            @foreach ($product as $p)
                <div class="card col-sm-3 border-0 m-1 p-0 rounded-3">
                    <div class="p-0">
                        <img src="{{ url('storage') }}/{{ $p->image }}" class="card-img-top w-100 rounded-3" alt="..."
                            style="min-height: 180px;">
                    </div>
                    <div class="card-body">
                        <hr>
                        <h5 class="card-title fw-semibold">{{ \Illuminate\Support\Str::limit($p->name, 12, '...') }}</h5>
                        <div class="d-flex">
                            <span class="card-text me-2 text-danger">{{ number_format($p->price) }} IDR</span>
                            <span class="px-3 py-0 rounded-3 rounded-md" id="button-prim">{{ $p->stock }} Stock</span>

                        </div>
                        <p class="card-text mt-1">{{ \Illuminate\Support\Str::limit($p->desc, 25, '...') }}</p>
                        <div class="d-flex">
                            <a href="{{ route('login') }}" class="p-2 me-1 rounded-md rounded-3 text-decoration-none"
                                id="button-prim"><i class="bi bi-bag-plus px-2"></i></a>
                            <a href="{{ route('login') }}" class="p-2 rounded-md rounded-3 text-decoration-none"
                                id="button-sec"><i class="bi bi-cart me-2"></i>Pesan
                                Sekarang</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
