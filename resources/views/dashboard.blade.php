<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('ui.title.dashboard') }}
        </h2>
    </x-slot>

    <div class="grid grid-flow-row gap-8 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        <div class="my-2">
            @livewire('route.route-small-manager')
        </div>
        <div class="my-2">
            @livewire('refilling.refilling-small-manager')
        </div>
        <div class="my-2">
            @livewire('salary.salary-small-manager')
        </div>
    </div>

</x-app-layout>
