@extends('layouts.error')
@section('content')
    <div class="container mt-5">
        <div class="text-center">
            <img src="{{ asset('assets/img/404-error.png') }}" alt="404 Not_Found" width="280">
            <p class="text-capitalize mt-3 fs-4 clr-primary">you cannot access this page ...</p>
            <a href="{{ route('/') }}" class="btn text-light px-3" id="bg-secondary"><i class="bi bi-arrow-left"></i></a>
        </div>
    </div>
@endsection
