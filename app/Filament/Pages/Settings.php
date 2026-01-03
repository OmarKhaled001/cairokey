<?php

namespace App\Filament\Pages;

use BackedEnum;
use App\Models\Setting;
use Filament\Schemas\Schema;
use Filament\Pages\SettingsPage;
use App\Settings\GeneralSettings;
use Filament\Support\Icons\Heroicon;
use Filament\Schemas\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Tabs\Tab;

class Settings extends SettingsPage
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?string $modelLabel = 'إعدادات';
    protected static ?string $navigationLabel = 'إعدادات';
    protected static ?string $pluralModelLabel = 'إعدادات';
    protected static string $settings = Setting::class;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(Setting::allCached());
    }
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('SettingsTabs')
                    ->tabs([

                        /* ================= General ================= */
                        Tab::make('General')
                            ->label('عام')
                            ->icon(Heroicon::OutlinedHome)
                            ->schema([
                                Section::make()
                                    ->schema([
                                        TextInput::make('name')
                                            ->label('اسم الموقع')
                                            ->required()
                                            ->maxLength(255),
                                    ]),
                            ]),

                        /* ================= Branding ================= */
                        Tab::make('Branding')
                            ->label('الهوية')
                            ->icon(Heroicon::OutlinedPhoto)
                            ->schema([
                                Section::make()
                                    ->columns(2)
                                    ->schema([
                                        FileUpload::make('logo')
                                            ->label('شعار الموقع')
                                            ->disk('public')
                                            ->visibility('public')
                                            ->directory('settings')
                                            ->image()
                                            ->imageEditor()
                                            ->previewable()
                                            ->downloadable()
                                            ->columnSpanFull(),

                                        FileUpload::make('favicon')
                                            ->label('أيقونة الموقع')
                                            ->disk('public')
                                            ->visibility('public')
                                            ->directory('settings')
                                            ->image()
                                            ->imageCropAspectRatio('1:1')
                                            ->helperText('يفضل 32x32 أو 64x64'),
                                    ]),
                            ]),

                        /* ================= SEO ================= */
                        Tab::make('SEO')
                            ->label('SEO')
                            ->icon(Heroicon::OutlinedMagnifyingGlass)
                            ->schema([

                                /* ================= Meta Title ================= */
                                TextInput::make('seo_title')
                                    ->label('عنوان الموقع (Meta Title)')
                                    ->required()
                                    ->maxLength(60)
                                    ->helperText('يفضل من 50 إلى 60 حرف'),

                                /* ================= Meta Description ================= */
                                Textarea::make('seo_description')
                                    ->label('وصف الموقع (Meta Description)')
                                    ->rows(3)
                                    ->maxLength(160)
                                    ->helperText('يفضل من 150 إلى 160 حرف'),

                                /* ================= Meta Keywords ================= */
                                TextInput::make('seo_keywords')
                                    ->label('الكلمات المفتاحية (Keywords)')
                                    ->placeholder('real estate, apartments, cairo')
                                    ->helperText('افصل بين الكلمات بفاصلة')
                                    ->maxLength(255),

                                /* ================= OG Image (Optional) ================= */
                                TextInput::make('seo_og_image')
                                    ->label('OG Image URL')
                                    ->url()
                                    ->helperText('تظهر عند مشاركة الموقع على السوشيال ميديا'),
                            ])
                            ->columns(1),
                        /* ================= Contact ================= */
                        Tab::make('Contact')
                            ->label('التواصل')
                            ->icon(Heroicon::OutlinedPhone)
                            ->schema([
                                TextInput::make('email')
                                    ->label('البريد الإلكتروني')
                                    ->email()
                                    ->maxLength(255)
                                    ->placeholder('info@example.com'),

                                TextInput::make('phone')
                                    ->label('رقم الهاتف')
                                    ->tel()
                                    ->maxLength(20)
                                    ->placeholder('+20 10 0000 0000'),

                                TextInput::make('whatsapp')
                                    ->label('واتساب')
                                    ->tel()
                                    ->placeholder('https://wa.me/201000000000'),

                                /* ================= Social Media ================= */
                                TextInput::make('facebook')
                                    ->label('Facebook')
                                    ->url()
                                    ->prefixIcon('heroicon-o-globe-alt')
                                    ->placeholder('https://facebook.com/yourpage'),

                                TextInput::make('instagram')
                                    ->label('Instagram')
                                    ->url()
                                    ->placeholder('https://instagram.com/yourpage'),

                                TextInput::make('snapchat')
                                    ->label('Snapchat')
                                    ->url()
                                    ->placeholder('https://snapchat.com/add/username'),

                                TextInput::make('tiktok')
                                    ->label('TikTok')
                                    ->url()
                                    ->placeholder('https://tiktok.com/@username'),

                                TextInput::make('youtube')
                                    ->label('YouTube')
                                    ->url()
                                    ->placeholder('https://youtube.com/@channel'),
                            ]),


                    ])->columnSpanFull(),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        Setting::setMany($this->form->getState());

        Notification::make()
            ->success()
            ->title('تم حفظ الإعدادات')
            ->send();
    }
}
