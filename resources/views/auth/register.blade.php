@extends('layouts.master')

@section('name', 'إنشاء حساب - كايرو كي')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}">
@endpush

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h2>إنشاء حساب جديد</h2>
            <p>انضم إلينا لاستكشاف أفخم أماكن الإقامة.</p>
        </div>

        <!-- Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                عذراً! حدث خطأ ما.
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <div class="input-wrapper">
                    <i class="fas fa-user input-icon"></i>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                           name="name" value="{{ old('name') }}" required autofocus placeholder="الاسم الكامل">
                </div>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <div class="input-wrapper">
                    <i class="fas fa-envelope input-icon"></i>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                           name="email" value="{{ old('email') }}" required placeholder="البريد الإلكتروني">
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
                           name="password" required autocomplete="new-password" placeholder="كلمة المرور">
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <div class="input-wrapper">
                    <i class="fas fa-lock input-icon"></i>
                    <input id="password_confirmation" type="password" class="form-control" 
                           name="password_confirmation" required placeholder="تأكيد كلمة المرور">
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-auth">
                إنشاء حساب
                <i class="fas fa-user-plus" style="font-size: 0.9em;"></i>
            </button>

            <div style="text-align: center; margin-top: 1.5rem; font-size: 0.95rem;">
                <span style="color: var(--text-light);">لديك حساب بالفعل؟</span>
                <a href="{{ route('login') }}" class="auth-link">تسجيل الدخول</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/auth.js') }}"></script>
@endpush
