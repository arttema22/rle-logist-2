<x-moonshine::layout>
    <x-moonshine::layout.html :with-alpine-js="true" :with-themes="true">
        <x-moonshine::layout.head>
            <x-moonshine::layout.meta name="csrf-token" :content="csrf_token()" />
            <x-moonshine::layout.favicon />
            <x-moonshine::layout.assets>
                @vite([
                'resources/css/main.css',
                'resources/js/app.js',
                ], 'vendor/moonshine')
            </x-moonshine::layout.assets>
        </x-moonshine::layout.head>

        <x-moonshine::layout.body>
            <x-moonshine::layout.wrapper>

                <x-moonshine::layout.div class="layout-page">
                    <x-moonshine::layout.header>
                        <x-moonshine::breadcrumbs :items="['#' => 'Home']" />
                        <x-moonshine::layout.locales :locales="collect()" />
                        @if (Route::has('login'))
                        <livewire:welcome.navigation />
                        @endif
                    </x-moonshine::layout.header>
                    <x-moonshine::layout.content>
                        <x-moonshine::carousel :items="[
                            '/img/carusel/forest-06.jpg',
                            '/img/carusel/forest-05.jpg']" />
                    </x-moonshine::layout.content>
                    <x-moonshine::layout.footer>
                        All rights reserved
                    </x-moonshine::layout.footer>
                </x-moonshine::layout.div>
            </x-moonshine::layout.wrapper>
        </x-moonshine::layout.body>
    </x-moonshine::layout.html>
</x-moonshine::layout>