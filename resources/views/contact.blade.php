@extends('layouts.master')

@section('name', 'اتصل بنا - كايرو كي')

@section('content')
<div class="container section-padding">
    <div class="section-title">
        <h2>تواصل معنا</h2>
    </div>
    <form style="max-width: 600px; margin: 0 auto; display: flex; flex-direction: column; gap: 1rem;">
        <input type="text" name="name" id="contact-name" placeholder="الاسم" style="padding: 10px; border: 1px solid var(--border-color); border-radius: var(--radius-md);">
        <input type="email" name="email" id="contact-email" placeholder="البريد الإلكتروني" style="padding: 10px; border: 1px solid var(--border-color); border-radius: var(--radius-md);">
        <textarea name="message" id="contact-message" rows="5" placeholder="الرسالة" style="padding: 10px; border: 1px solid var(--border-color); border-radius: var(--radius-md);"></textarea>
        <button type="submit" class="btn btn-primary">إرسال الرسالة</button>
    </form>
</div>
@endsection
