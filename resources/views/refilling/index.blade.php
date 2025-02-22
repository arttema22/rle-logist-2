<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('ui.title.refillings') }}
        </h2>
    </x-slot>

    @livewire('refilling.refilling-manager')

</x-app-layout>
