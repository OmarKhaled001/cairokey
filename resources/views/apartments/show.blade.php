@extends('layouts.master')

@section('name', $apartment->name . ' - كايرو كي')

@section('content')

    <!-- Header Image -->
    <section
        style="
    height: 60vh;
    background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ $apartment->main_image_url }}');
    background-size: cover;
    background-position: center;">
    </section>

    <section class="section-padding">
        <div class="container">

            <div class="grid grid-cols-3 gap-4">

                <!-- Apartment Details -->
                <div class="col-span-2" style="padding: 1rem;">

                    <h1 style="font-size: 2rem; margin-bottom: 10px;">{{ $apartment->name }}</h1>

                    <p style="color: var(--text-light); margin-bottom: 1rem;">
                        <i class="fas fa-map-marker-alt"></i>
                        {{ $apartment->location }}
                    </p>

                    <div class="grid grid-cols-3 gap-4" style="margin-bottom: 2rem;">
                        <div class="card" style="padding: 1rem; text-align:center;">
                            <i class="fas fa-bed" style="font-size: 2rem; color: var(--primary-color);"></i>
                            <p>{{ $apartment->rooms }} غرف</p>
                        </div>
                        <div class="card" style="padding: 1rem; text-align:center;">
                            <i class="fas fa-couch" style="font-size: 2rem; color: var(--primary-color);"></i>
                            <p>{{ $apartment->beds }} سرائر</p>
                        </div>
                        <div class="card" style="padding: 1rem; text-align:center;">
                            <i class="fas fa-ruler-combined" style="font-size: 2rem; color: var(--primary-color);"></i>
                            <p>{{ $apartment->size }} م²</p>
                        </div>
                    </div>

                    <h3 style="margin-bottom: 1rem;">الوصف</h3>
                    <p style="line-height: 1.8; color: var(--text-light);">
                        {{ $apartment->description }}
                    </p>

                </div>

                <!-- Booking & Price -->
                <div>
                    <div
                        style="background: var(--bg-light); padding: 1.5rem; border-radius: var(--radius-lg); box-shadow: var(--card-shadow);">

                        <h3 style="margin-bottom: 1rem;">السعر</h3>

                        <p style="font-size: 1.5rem; color: var(--primary-color); font-weight:bold;">
                            ${{ $apartment->price }} / ليلة
                        </p>

                        <button class="btn btn-primary" style="width: 100%; margin-top: 1rem;">
                            اطلب الحجز الآن
                        </button>

                    </div>
                </div>

            </div>

            <!-- Gallery -->
            @if ($apartment->gallery && count($apartment->gallery))
                <h3 style="margin-top: 3rem; margin-bottom: 1rem;">معرض الصور</h3>

                <div class="grid grid-cols-3 gap-4">
                    @foreach ($apartment->gallery as $img)
                        <img src="{{ $img }}"
                            style="width:100%; height:220px; object-fit:cover; border-radius: var(--radius-md);">
                    @endforeach
                </div>
            @endif

        </div>
    </section>

@endsection
