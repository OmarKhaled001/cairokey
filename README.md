# CairoKey

Minimal README — setup, conventions, and quick notes.

## Requirements
- PHP 8.4.18
- Laravel v12
- Node (recommended stable), npm
- Composer
- TailwindCSS v4 (project uses Tailwind conventions)
- Filament v5, Livewire v4 (installed packages per project)

## Quick setup
  composer install
  cp .env.example .env
  php artisan key:generate
  php artisan migrate --seed --no-interaction

  npm install
  npm run dev    # local assets
  npm run build  # production

If you see "Unable to locate file in Vite manifest" run `npm run build` or `composer run dev`.

## Development helpers
- Run dev server: `php artisan serve`
- Run tests (Pest): `php artisan test --compact`
- Create tests: `php artisan make:test --pest Name`
- Format PHP: `vendor/bin/pint --format agent`

## Conventions & guidelines
- Use artisan `make:` commands for controllers, models, requests, tests.
- Create Form Request classes for validation.
- Prefer Eloquent with eager loading to avoid N+1.
- Use factories in tests; follow existing factory states.
- Follow project Tailwind patterns and class conventions.

## Styling & UI notes
- Main stylesheet: `public/assets/css/main.css` — contains:
  - RTL/LTR direction-aware rules (html[lang], [dir="rtl"])
  - Description width limits: `max-width: 70ch` for `.description`, `.card-description`, etc.
  - Theme tokens and `data-theme="dark"` support
  - Mobile-first responsive breakpoints and slide-in panels
- After CSS changes run `npm run dev` / `npm run build` to see updates.

## Accessibility & prefs
- `prefers-reduced-motion` and `prefers-contrast` respected in styles.
- Use semantic HTML and logical properties (inset-inline, margin-inline) where possible.

## Helpful commands
  php artisan route:list
  php artisan config:show app
  php artisan tinker --execute "Model::query()->count()"

## Notes
- Keep commits small and follow existing file structure.
- Ask before adding new top-level folders or changing dependencies.

```