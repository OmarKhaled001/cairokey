

<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div x-data="{ state: $wire.$entangle('{{ $getStatePath() }}') }">
        <div class="text-left">
            <div class="mt-4 text-gray-600 text-sm mb-2">
                {{ __('filament-general-settings::default.seo_preview_helper_text') }}
            </div>
        </div>

        <div class="bg-white shadow-lg rounded-lg w-full">
            <div class="flex items-center justify-between p-3 bg-gray-200 rounded-t-lg">
                <div class="flex items-center space-x-2">
                    <div class="h-3 w-3 bg-red-500 rounded-full" style="margin-right: 9px;"></div>
                    <div class="h-3 w-3 bg-yellow-500 rounded-full"></div>
                    <div class="h-3 w-3 bg-green-500 rounded-full"></div>
                </div>
                <div class="flex items-center space-x-2">
                    <x-filament::icon icon="heroicon-o-globe-alt" class="h-5 w-5 text-gray-600" />
                </div>
            </div>
            <div class="p-4">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold mb-1">
                        <a href="#" class="text-blue-600 hover:underline">
                            @if(!empty($this->data['seo_title']))
                                {{ $this->data['seo_title'] }}
                            @else
                                SEO Title field
                            @endif
                        </a>
                    </h3>
                    <p class="text-sm text-green-600">
                        @if(!empty($this->data['seo_metadata']['og:url']))
                            {{ $this->data['seo_metadata']['og:url'] }}
                        @else
                            og:url
                        @endif
                    </p>
                    <p class="text-sm text-gray-600 mt-1">
                        @if(!empty($this->data['seo_metadata']['og:description']))
                            {{ $this->data['seo_metadata']['og:description'] }}
                        @else
                            og:description
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-dynamic-component>
