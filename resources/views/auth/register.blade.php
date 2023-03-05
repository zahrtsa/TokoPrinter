@extends('layouts.app')
@section('title', 'Register')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="bg-white rounded-md rounded-3 p-4">
                    <p class="mb-3 fs-3 fw-semibold">Register</p>
                    <form action="{{ route('register') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="exampleInputtext" name="name" required placeholder="Username">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="exampleInputEmail1" name="email" aria-describedby="emailHelp" required
                                placeholder="Name@gmail.com">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="exampleInputPassword1" name="password" required placeholder="************">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn" id="button-sec">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
