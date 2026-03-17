<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class Settings extends SettingsPage
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    public static function getModelLabel(): string       { return __('Settings'); }
    public static function getNavigationLabel(): string  { return __('Settings'); }
    public static function getPluralModelLabel(): string { return __('Settings'); }

    public ?array $data = [];

    // ── Keys ──────────────────────────────────────────
    protected array $translatableKeys = [
        'name', 'hero_title', 'hero_description',
        'seo_title', 'seo_description', 'seo_keywords',
    ];

    protected array $plainKeys = [
        'logo', 'logo_light', 'favicon', 'hero_cover',
        'seo_og_image', 'email', 'phone', 'whatsapp',
        'facebook', 'instagram', 'snapchat', 'tiktok', 'youtube',
    ];

    // ── Lifecycle ─────────────────────────────────────

    public function mount(): void
    {
        $formData = [];

        foreach ($this->plainKeys as $key) {
            $formData[$key] = Setting::get($key);
        }

        foreach ($this->translatableKeys as $key) {
            $translations = Setting::getWithTranslations($key) ?? [];
            $formData["{$key}_en"] = $translations['en'] ?? null;
            $formData["{$key}_ar"] = $translations['ar'] ?? null;
        }

        $this->form->fill($formData);
    }

    // ── Form ──────────────────────────────────────────

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                Tabs::make('SettingsTabs')
                    ->columnSpanFull()
                    ->tabs([
                        $this->generalTab(),
                        $this->brandingTab(),
                        $this->seoTab(),
                        $this->contactTab(),
                    ]),
            ]);
    }

    // ── Save ──────────────────────────────────────────

    public function save(): void
    {
        $state   = $this->form->getState();
        $payload = [];

        foreach ($this->plainKeys as $key) {
            $payload[$key] = $state[$key] ?? null;
        }

        foreach ($this->translatableKeys as $key) {
            $payload[$key] = [
                'en' => $state["{$key}_en"] ?? null,
                'ar' => $state["{$key}_ar"] ?? null,
            ];
        }

        Setting::setMany($payload);

        Notification::make()
            ->success()
            ->title(__('Settings saved successfully'))
            ->send();
    }

    // ── Tab builders ──────────────────────────────────

    private function localeTabs(array $fields): Tabs
    {
        return Tabs::make('locale')
            ->tabs([
                Tab::make('English')->schema(
                    array_map(fn ($field) => $field('en', 'English'), $fields)
                ),
                Tab::make('العربية')->schema(
                    array_map(fn ($field) => $field('ar', 'Arabic'), $fields)
                ),
            ]);
    }

    private function generalTab(): Tab
    {
        return Tab::make('General')
            ->label(__('General'))
            ->icon('heroicon-o-home')
            ->schema([
                Section::make()->schema([
                    $this->localeTabs([
                        fn (string $locale) => TextInput::make("name_{$locale}")
                            ->label(__('Site Name'))
                            ->required($locale === 'en')
                            ->maxLength(255),
                    ]),
                ]),
            ]);
    }

    private function brandingTab(): Tab
    {
        return Tab::make('Branding')
            ->label(__('Branding'))
            ->icon('heroicon-o-photo')
            ->schema([
                Section::make()
                    ->columns(3)
                    ->schema([
                        FileUpload::make('logo')
                            ->label(__('Site Logo'))
                            ->disk('public')->visibility('public')
                            ->directory('settings')
                            ->image()->downloadable()->imageEditor()
                            ->helperText('Recommended size: 200x50px'),

                        FileUpload::make('logo_light')
                            ->label(__('Site Logo (Light Mode)'))
                            ->disk('public')->visibility('public')
                            ->directory('settings')
                            ->image()->downloadable()->imageEditor()
                            ->helperText('For dark backgrounds'),

                        FileUpload::make('favicon')
                            ->label(__('Site Favicon'))
                            ->disk('public')->visibility('public')
                            ->directory('settings')
                            ->image()->imageEditor()
                            ->helperText(__('Preferably 32x32 or 64x64')),
                    ]),

                Section::make('Hero Section')
                    ->columnSpanFull()
                    ->schema([
                        $this->localeTabs([
                            fn (string $locale) => TextInput::make("hero_title_{$locale}")
                                ->label(__('Hero Title'))
                                ->required($locale === 'en')
                                ->maxLength(255),

                            fn (string $locale) => Textarea::make("hero_description_{$locale}")
                                ->label(__('Hero Description'))
                                ->rows(3)->maxLength(160)
                                ->helperText(__('Preferably between 150 and 160 characters')),
                        ]),

                        FileUpload::make('hero_cover')
                            ->label(__('Hero Cover Image'))
                            ->disk('public')->visibility('public')
                            ->directory('settings/hero')
                            ->image()->downloadable()->imageEditor()->columnSpanFull()
                            ->helperText('Recommended size: 1920x600px'),
                    ]),
            ]);
    }

    private function seoTab(): Tab
    {
        return Tab::make('SEO')
            ->label('SEO')
            ->icon('heroicon-o-magnifying-glass')
            ->schema([
                Section::make()->columns(1)->schema([
                    $this->localeTabs([
                        fn (string $locale) => TextInput::make("seo_title_{$locale}")
                            ->label(__('Meta Title'))
                            ->required($locale === 'en')
                            ->maxLength(60)
                            ->helperText(__('Preferably between 50 and 60 characters')),

                        fn (string $locale) => Textarea::make("seo_description_{$locale}")
                            ->label(__('Meta Description'))
                            ->rows(3)->maxLength(160)
                            ->helperText(__('Preferably between 150 and 160 characters')),

                        fn (string $locale) => TextInput::make("seo_keywords_{$locale}")
                            ->label(__('Keywords'))
                            ->placeholder('real estate, apartments, cairo')
                            ->helperText(__('Separate words with commas'))
                            ->maxLength(255),
                    ]),

                    TextInput::make('seo_og_image')
                        ->label('OG Image URL')
                        ->url()
                        ->helperText(__('Appears when sharing the site on social media')),
                ]),
            ]);
    }

    private function contactTab(): Tab
    {
        return Tab::make('Contact')
            ->label(__('Communication'))
            ->icon('heroicon-o-phone')
            ->schema([
                Section::make('Contact Information')
                    ->columns(2)
                    ->schema([
                        TextInput::make('email')
                            ->label(__('Email'))->email()->maxLength(255)
                            ->placeholder('info@example.com'),

                        TextInput::make('phone')
                            ->label(__('Phone'))->tel()->maxLength(20)
                            ->placeholder('+20 10 0000 0000'),

                        TextInput::make('whatsapp')
                            ->label(__('WhatsApp'))->tel()
                            ->placeholder('https://wa.me/201000000000'),
                    ]),

                Section::make('Social Media')
                    ->columns(2)
                    ->schema([
                        TextInput::make('facebook')->label('Facebook')->url()
                            ->prefix('https://')->placeholder('facebook.com/yourpage'),

                        TextInput::make('instagram')->label('Instagram')->url()
                            ->prefix('https://')->placeholder('instagram.com/yourpage'),

                        TextInput::make('snapchat')->label('Snapchat')->url()
                            ->prefix('https://')->placeholder('snapchat.com/add/username'),

                        TextInput::make('tiktok')->label('TikTok')->url()
                            ->prefix('https://')->placeholder('tiktok.com/@username'),

                        TextInput::make('youtube')->label('YouTube')->url()
                            ->prefix('https://')->placeholder('youtube.com/@channel'),
                    ]),
            ]);
    }
}
