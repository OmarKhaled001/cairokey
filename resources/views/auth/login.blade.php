@extends('layouts.master')

@section('name', 'تسجيل الدخول - كايرو كي')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}">
    <style>
        .btn-google {
            background-color: #eb4132;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 0.35rem;
            font-weight: 500;
            transition: background 0.3s;
        }

        .btn-google:hover {
            background-color: #357ae8;
        }

        .btn-google i {
            font-size: 1.1rem;
        }
    </style>
@endpush

@section('content')
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h2>مرحباً بعودتك</h2>
                <p>يرجى إدخال بياناتك لتسجيل الدخول.</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('status') }}
                </div>
            @endif

            <!-- Errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    عذراً! حدث خطأ ما.
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <div class="input-wrapper">
                        <i class="fas fa-envelope input-icon"></i>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autofocus placeholder="البريد الإلكتروني">
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <div class="input-wrapper">
                        <i class="fas fa-lock input-icon"></i>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password" placeholder="كلمة المرور">
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="form-options">
                    <label for="remember_me" class="checkbox-label">
                        <input id="remember_me" type="checkbox" name="remember" style="accent-color: var(--primary-color);">
                        <span>تذكرني</span>
                    </label>


                </div>

                <button type="submit" class="btn btn-primary btn-auth">
                    تسجيل الدخول
                    <i class="fas fa-arrow-left" style="font-size: 0.9em;"></i>
                </button>
            </form>

            <!-- OR Divider -->
            <div style="text-align: center; margin: 1.5rem 0; font-weight: 500; color: var(--text-light);">
                أو
            </div>

            <!-- Google Login -->
            <a href="{{ route('google.redirect') }}" class="btn-google">
                <i class="fab fa-google"></i> تسجيل الدخول بواسطة Google
            </a>

            <div style="text-align: center; margin-top: 1.5rem; font-size: 0.95rem;">
                <span style="color: var(--text-light);">ليس لديك حساب؟</span>
                <a href="{{ route('register') }}" class="auth-link">إنشاء حساب جديد</a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/auth.js') }}"></script>
@endpush
