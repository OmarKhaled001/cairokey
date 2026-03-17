@extends('layouts.master')

@section('name', __('general.our_services') . ' - ' . __('general.cairo_key'))

@push('styles')

@endpush

@section('content')

    <section class="hero-search">
        <div class="container text-center">
            <h1 style="font-weight: 800; font-size: 2.5rem; margin-bottom: 0.5rem;">{{ __('general.our_services') }}</h1>
        </div>
    </section>

    <div class="container section-padding">
        <div class="main-layout">
            <main>
                @if ($services->count() > 0)
                    <div class="grid main-search-grid"
                        style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem;">
                        @foreach ($services as $service)
                            <div class="search-card"
                                style="background:white;border-radius:12px;box-shadow:var(--card-shadow);overflow:hidden;">

                                <div class="card-image"
                                    style="background-image:url('{{ $service->cover ? asset('storage/' . $service->cover) : 'https://placehold.co/600x400?text=Offer' }}');">

                                    @if ($service->featured)
                                        <span class="badge-featured">{{ __('general.featured') }}</span>
                                    @endif
                                </div>

                                <div class="card-body p-3 text-center">
                                    <a href="{{ route('services.show', $service->slug) }}">
                                        <h3>{{ $service->name }}</h3>
                                    </a>

                                    <p class="text-muted small">
                                        {{ \Illuminate\Support\Str::limit($service->description, 80) }}
                                    </p>
                                    <a href="{{ route('services.show', $service->slug) }}" id="whatsappBook"
                                        class="btn btn-primary mt-3">
                                        {{ __('general.view_details') }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="pagination-wrapper mt-5">
                        {{ $services->links() }}
                    </div>
                @else
                    <div style="text-align: center; padding: 5rem 2rem;">
                        <i class="fas fa-search-minus" style="font-size: 4rem; color: #cbd5e1; margin-bottom: 1.5rem;"></i>
                        <h2 style="font-weight: 800;">{{ __('general.no_services_found') }}</h2>
                        <a href="{{ url('/') }}" class="btn btn-primary mt-3" style="border-radius: 12px;">{{ __('general.back_to_home') }}</a>
                    </div>
                @endif
            </main>
        </div>
    </div>
@endsection
