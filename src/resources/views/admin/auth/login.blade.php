@extends('layouts.auth')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="m-sm-3">
                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input id="email" type="email"
                            class="form-control form-control-lg @error('email') is-invalid @enderror" name="email"
                            placeholder="Nhập email của bạn" value="{{ old('email') }}" required autocomplete="email"
                            autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mật khẩu</label>
                        <input id="password" type="password"
                            class="form-control form-control-lg @error('password') is-invalid @enderror" name="password"
                            placeholder="Nhập mật khẩu của bạn" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div>
                        <div class="form-check align-items-center">
                            <input id="customControlInline" type="checkbox" class="form-check-input" value="remember-me"
                                name="remember-me" disabled>
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
