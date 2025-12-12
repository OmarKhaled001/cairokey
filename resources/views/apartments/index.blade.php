@extends('layouts.master')

@section('name', 'الشقق المتاحة - كايرو كي')

@section('content')

    <!-- Header Section -->
    <section class="hero-section"
        style="
    height: 40vh;
    background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('https://placehold.co/1200x600?text=Apartments');
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: white;">
        <h1 style="font-size: 2.5rem;">الشقق المتاحة</h1>
    </section>

    <!-- Apartments Listing -->
    <section class="section-padding">
        <div class="container">
            <div class="grid grid-cols-3 gap-4">

                @foreach ($apartments as $apartment)
                    <div
                        style="background: var(--bg-light); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--card-shadow);">

                        <div
                            style="height: 230px; background-image: url('{{ $apartment->main_image_url }}'); background-size: cover; background-position: center;">
                        </div>

                        <div style="padding: 1.5rem;">
                            <h3>{{ $apartment->name }}</h3>

                            <p style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 0.5rem;">
                                <i class="fas fa-map-marker-alt"></i>
                                {{ $apartment->location }}
                            </p>

                            <p style="color: var(--text-light); font-size: 0.9rem;">
                                <i class="fas fa-bed"></i>
                                {{ $apartment->rooms }} غرف نوم
                            </p>

                            <div class="d-flex justify-between align-center" style="margin-top: 1rem;">
                                <span style="color: var(--primary-color); font-weight: bold; font-size: 1.1rem;">
                                    ${{ $apartment->price }} / ليلة
                                </span>

                                <a href="{{ route('apartments.show', $apartment->slug) }}" class="btn btn-primary"
                                    style="padding: 0.5rem 1rem;">
                                    التفاصيل
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

@endsection
