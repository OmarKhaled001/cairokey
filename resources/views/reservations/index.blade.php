@extends('layouts.master')

@section('name', 'حجوزاتي - كايرو كي')

@section('content')
<div class="container section-padding">
    <div class="section-title text-center">
        <h2>حجوزاتي</h2>
    </div>
    
    <!-- Active Reservations -->
    <div style="margin-bottom: 3rem;">
        <h3 style="margin-bottom: 1rem;">الحجوزات الحالية</h3>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; min-width: 600px;">
                <thead>
                    <tr style="background: var(--bg-secondary); text-align: right;">
                        <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">العنصر</th>
                        <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">التاريخ</th>
                        <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">الحالة</th>
                        <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">السعر</th>
                        <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 1rem; border-bottom: 1px solid var(--border-color);">
                            <strong>جناح النيل الفاخر</strong><br>
                            <span style="font-size: 0.9rem; color: var(--text-light);">#RES-12345</span>
                        </td>
                        <td style="padding: 1rem; border-bottom: 1px solid var(--border-color);">12 أكتوبر - 15 أكتوبر 2025</td>
                        <td style="padding: 1rem; border-bottom: 1px solid var(--border-color);">
                            <span style="background: #dcfce7; color: #166534; padding: 0.25rem 0.75rem; border-radius: 999px; font-size: 0.85rem; font-weight: 600;">مؤكد</span>
                        </td>
                        <td style="padding: 1rem; border-bottom: 1px solid var(--border-color); font-weight: bold;">$450</td>
                        <td style="padding: 1rem; border-bottom: 1px solid var(--border-color);">
                            <a href="#" style="color: var(--primary-color);">عرض</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- History -->
    <div>
        <h3 style="margin-bottom: 1rem;">السجل السابق</h3>
        <p style="color: var(--text-light); font-style: italic;">لا توجد حجوزات سابقة.</p>
    </div>
</div>
@endsection
