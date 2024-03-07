@extends('layouts.auth')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="m-sm-3">
                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input id="email" type="text" class="form-control form-control-lg" name="email"
                            placeholder="Nhập email của bạn" value="{{ old('email') }}" autocomplete="email" autofocus>

                        @error('email')
                            <div class="text-danger mt-1" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mật khẩu</label>
                        <input id="password" type="password" class="form-control form-control-lg" name="password"
                            placeholder="Nhập mật khẩu của bạn" autocomplete="current-password">

                        @error('password')
                            <div class="text-danger mt-1" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div>
                        <div class="form-check align-items-center">
                            <input class="form-check-input" type="checkbox" name="remember" id="customControlInline">
                            <label class="form-check-label text-small" for="customControlInline">Ghi nhớ đăng nhập</label>
                        </div>
                    </div>
                    <div class="d-grid gap-2 mt-3">
                        <button type="submit" class='btn btn-lg btn-primary'>Đăng nhập</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="text-center mb-3">
        Quên mật khẩu? <a href='#!'>Đặt lại mật khẩu</a>
    </div>
@endsection
