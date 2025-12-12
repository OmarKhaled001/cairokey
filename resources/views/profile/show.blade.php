@extends('layouts.master')

@section('name', 'الملف الشخصي - كايرو كي')

@section('content')
<div class="container section-padding">
    <div class="d-flex gap-4" style="align-items: flex-start;">
        <!-- Sidebar -->
        <div style="flex: 1; background: var(--bg-light); padding: 2rem; border-radius: var(--radius-lg); box-shadow: var(--card-shadow); text-align: center;">
            <div style="width: 100px; height: 100px; background: #ddd; border-radius: 50%; margin: 0 auto 1rem;"></div>
            <h3>أحمد محمد</h3>
            <p style="color: var(--text-light);">ahmed@example.com</p>
            <hr style="margin: 1.5rem 0; border: 0; border-top: 1px solid var(--border-color);">
            <ul style="text-align: right;">
                <li style="margin-bottom: 1rem;"><a href="#" style="color: var(--primary-color);">بياناتي</a></li>
                <li style="margin-bottom: 1rem;"><a href="{{ url('/reservations') }}" style="color: var(--text-dark);">حجوزاتي</a></li>
                <li><a href="#" style="color: var(--text-dark);">تسجيل الخروج</a></li>
            </ul>
        </div>
        
        <!-- Content -->
        <div style="flex: 3; background: var(--bg-light); padding: 2rem; border-radius: var(--radius-lg); box-shadow: var(--card-shadow);">
            <div class="d-flex justify-between align-center" style="margin-bottom: 2rem;">
                <h2>البيانات الشخصية</h2>
                <button class="btn btn-primary">تعديل الملف</button>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; color: var(--text-light);">الاسم الكامل</label>
                    <div style="padding: 10px; background: var(--bg-secondary); border-radius: var(--radius-md);">أحمد محمد</div>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; color: var(--text-light);">رقم الهاتف</label>
                    <div style="padding: 10px; background: var(--bg-secondary); border-radius: var(--radius-md);">+20 123 456 789</div>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; color: var(--text-light);">البريد الإلكتروني</label>
                    <div style="padding: 10px; background: var(--bg-secondary); border-radius: var(--radius-md);">ahmed@example.com</div>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; color: var(--text-light);">تاريخ الانضمام</label>
                    <div style="padding: 10px; background: var(--bg-secondary); border-radius: var(--radius-md);">15 يناير 2024</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
