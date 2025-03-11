@extends('layouts.guest')

@section('styles')
    <style>
        .form-control-lg {
            font-size: 13px;
        }

        .form-control-lg:focus {
            box-shadow: none;
            border-color: #e0e0e0
        }
    </style>
@endsection

@section('content')
    <div class="d-flex vh-100">
        <div class="col-md-6 d-flex justify-content-center align-items-center px-5">
            <div class="w-100 p-5 mx-5 text-center">
                <h4 style="color: #4a4a4a">
                    <i class="fa-solid fa-bag-shopping me-1" style="color: #ff0000;"></i>
                    Product Web App
                </h4>
                <h4 class="w-50 mx-auto my-5">Masuk atau buat akun untuk memulai</h4>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-4 px-5">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0">
                                <i class="fa-solid fa-envelope" style="color: #d0d0d0;"></i>
                            </span>
                            <input type="email" id="email" name="email"
                                class="form-control form-control-lg border-start-0 ps-0" placeholder="masukkan email anda"
                                value="{{ old('email') }}">
                        </div>

                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3 px-5">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0">
                                <i class="fa-solid fa-lock" style="color: #d0d0d0;"></i>
                            </span>
                            <input type="password" id="password" name="password"
                                class="form-control form-control-lg border-start-0 ps-0"
                                placeholder="masukkan password anda" value="">
                        </div>

                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mt-5 px-5">
                        <button type="submit" class="btn w-100 text-white" style="background-color: #ff0000">Masuk</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-6 p-0 d-flex align-items-center justify-content-center" style="background-color: #ff0000">
            <img src="{{ asset('images/login-frame.png') }}" class=""
                style="max-width: 100%; max-height: 100%; object-fit: contain;" alt="Login">
        </div>
    </div>
@endsection
