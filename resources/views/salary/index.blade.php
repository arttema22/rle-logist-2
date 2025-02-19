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
                <x-moonshine::layout.sidebar :collapsed="true">
                    <x-moonshine::layout.div class="menu-heading">
                        <x-moonshine::layout.div class="menu-heading-logo">
                            <x-moonshine::layout.logo href="/" logo="/logo.png" :minimized="true" />
                        </x-moonshine::layout.div>

                        <x-moonshine::layout.div class="menu-heading-actions">
                            <x-moonshine::layout.div class="menu-heading-mode">
                                <x-moonshine::layout.theme-switcher />
                            </x-moonshine::layout.div>
                            <x-moonshine::layout.div class="menu-heading-burger">
                                <x-moonshine::layout.burger />
                            </x-moonshine::layout.div>
                        </x-moonshine::layout.div>

                    </x-moonshine::layout.div>

                    <x-moonshine::layout.div class="menu" ::class="asideMenuOpen && '_is-opened'">
                        {{-- <x-moonshine::layout.menu
                            :elements="[['label' => 'Dashboard', 'url' => '/'], ['label' => 'Section', 'url' => '/section']]" /> --}}
                    </x-moonshine::layout.div>
                </x-moonshine::layout.sidebar>

                <x-moonshine::layout.div class="layout-page">
                    <x-moonshine::layout.header>
                        <x-moonshine::breadcrumbs :items="['#' => 'Home']" />
                        <x-moonshine::layout.search placeholder="Search" />
                        <x-moonshine::layout.locales :locales="collect()" />
                    </x-moonshine::layout.header>

                    <x-moonshine::layout.content>
                        <article class="article">
                            <h1>Ваш контент</h1>

                            @if (Route::has('login'))
                            <livewire:welcome.navigation />
                            @endif

                            <x-moonshine::table :columns="[
                                    '#', 'First', 'Last', 'Email'
                                ]" :values="[
                                    [1, fake()->firstName(), fake()->lastName(), fake()->safeEmail()],
                                    [2, fake()->firstName(), fake()->lastName(), fake()->safeEmail()],
                                    [3, fake()->firstName(), fake()->lastName(), fake()->safeEmail()]
                                ]" />

                            <x-moonshine::table :columns=$salaries :values=$salaries />

                        </article>
                    </x-moonshine::layout.content>
                    <x-moonshine::layout.footer copyright="Your brand"
                        :menu="['https://moonshine-laravel.com/docs' => 'Documentation']">
                        Any content
                    </x-moonshine::layout.footer>
                </x-moonshine::layout.div>
            </x-moonshine::layout.wrapper>
        </x-moonshine::layout.body>
    </x-moonshine::layout.html>
</x-moonshine::layout>