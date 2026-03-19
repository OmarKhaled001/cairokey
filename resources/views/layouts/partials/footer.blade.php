@php
    $siteName = setting('name', 'Cairo Key');
    $logo     = setting('logo_light');
    $isSvg    = $logo && str_ends_with(strtolower($logo), '.svg');

    // ضفنا الواتساب هنا مع تحقق بسيط للرابط
    $whatsappNum = setting('whatsapp', '01000000000');
    $whatsappUrl = str_starts_with($whatsappNum, 'http') ? $whatsappNum : "https://wa.me/" . preg_replace('/[^0-9]/', '', $whatsappNum);

    $socials = [
        ['icon' => 'fa-facebook-f', 'url' => setting('facebook'),  'name' => 'facebook'],
        ['icon' => 'fa-instagram',  'url' => setting('instagram'), 'name' => 'instagram'],
        ['icon' => 'fa-tiktok',     'url' => setting('tiktok'),    'name' => 'tiktok'],
        ['icon' => 'fa-whatsapp',   'url' => $whatsappUrl,         'name' => 'whatsapp'],
    ];
@endphp

<footer class="site-footer">
    <div class="container">
        <div class="footer-wrapper">

            <div class="footer-section brand-area">
                @if ($logo)
                    <img src="{{ asset('storage/' . $logo) }}"
                         alt="{{ $siteName }}"
                         class="footer-logo {{ $isSvg ? 'is-svg' : '' }}">
                @else
                    <h2 class="footer-title">{{ $siteName }}</h2>
                @endif
            </div>

            <div class="footer-section social-area">
                <div class="social-links">
                    @foreach ($socials as $social)
                        {{-- التحقق هنا بيضمن إن الأيقونة مش هتظهر لو الـ url فاضي أو null --}}
                        @if (!empty($social['url']))
                            <a href="{{ $social['url'] }}"
                               target="_blank"
                               rel="noopener"
                               aria-label="{{ $social['name'] }}"
                               class="social-item">
                                <i class="fab {{ $social['icon'] }}"></i>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="footer-section copyright-area">
                <p class="copyright-text">
                    &copy; {{ now()->year }} <strong>{{ $siteName }}</strong>.
                    {{ __('general.all_rights_reserved') }}
                </p>
            </div>

        </div>
    </div>
</footer>
