<footer
    style="background-color: #0f172a; color: white; padding: 4rem 0 2rem; margin-top: auto; border-top: 4px solid #b89355;">
    <div class="container">
        <div
            style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-start; gap: 2rem; direction: rtl; text-align: right;">

            {{-- قسم اللوجو والنبذة --}}
            <div style="flex: 1; min-width: 300px;">
                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 1.5rem;">
                    {{-- لو عندك لوجو صورة استبدل الـ <span> بـ <img> --}}
                    <span style="font-size: 2rem; font-weight: 900; color: #b89355; letter-spacing: -1px;">CAIRO<span
                            style="color: #fff;">KEY</span></span>
                </div>
                <p style="color: #cbd5e1; line-height: 1.8; font-size: 0.95rem; max-width: 450px;">
                    {{ \App\Models\Setting::get('about_us') ?? 'بوابتك الفاخرة للشقق والعقارات وتأجير السيارات الفخمة في القاهرة. استمتع بالأفضل معنا دائمًا.' }}
                </p>
            </div>

            {{-- قسم التواصل الاجتماعي --}}
            <div style="flex: 0 1 auto; min-width: 200px;">
                <h4
                    style="font-weight: 800; margin-bottom: 1.5rem; color: #fff; position: relative; padding-bottom: 10px;">
                    تواصل معنا
                    <span
                        style="position: absolute; bottom: 0; right: 0; width: 40px; height: 2px; background: #b89355;"></span>
                </h4>

                @php
                    $socials = [
                        [
                            'icon' => 'fab fa-whatsapp',
                            'link' =>
                                'https://wa.me/' . preg_replace('/[^0-9]/', '', \App\Models\Setting::get('whatsapp')),
                            'color' => '#25D366',
                        ],
                        [
                            'icon' => 'fab fa-facebook-f',
                            'link' => \App\Models\Setting::get('facebook'),
                            'color' => '#1877F2',
                        ],
                        [
                            'icon' => 'fab fa-instagram',
                            'link' => \App\Models\Setting::get('instagram'),
                            'color' => '#E4405F',
                        ],
                    ];
                @endphp

                <div style="display: flex; gap: 15px;">
                    @foreach ($socials as $social)
                        @if ($social['link'])
                            <a href="{{ $social['link'] }}" target="_blank"
                                style="width: 45px; height: 45px; background: rgba(255,255,255,0.05); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem; transition: 0.3s; border: 1px solid rgba(255,255,255,0.1);"
                                onmouseover="this.style.background='{{ $social['color'] }}'; this.style.borderColor='{{ $social['color'] }}'"
                                onmouseout="this.style.background='rgba(255,255,255,0.05)'; this.style.borderColor='rgba(255,255,255,0.1)'">
                                <i class="{{ $social['icon'] }}"></i>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        {{-- حقوق النشر --}}
        <div
            style="border-top: 1px solid rgba(255,255,255,0.05); margin-top: 3rem; padding-top: 1.5rem; text-align: center;">
            <p style="color: #64748b; font-size: 0.85rem; margin: 0;">
                &copy; {{ date('Y') }} <span style="color: #b89355; font-weight: 700;">كايرو كي</span>. جميع الحقوق
                محفوظة.
            </p>
        </div>
    </div>
</footer>
