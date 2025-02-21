<div class="relative mx-auto  bg-zinc-100 overflow-hidden border rounded-t-lg">
    <div class="flex justify-between px-6 py-4">
        {{__('ui.title.refillings')}}
        <button wire:click="create" title="{{__('ui.btn.new')}}">
            <div
                class="inline-flex items-center justify-center p-1 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500
                                    dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100
                                    dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">

                <svg class="h-6 w-6" viewBox="0 0 30 30" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M24,15v2h-7v7h-2v-7H8v-2h7V8h2v7H24z M24.485,24.485c-4.686,4.686-12.284,4.686-16.971,0
            	c-4.686-4.686-4.686-12.284,0-16.971c4.687-4.686,12.284-4.686,16.971,0C29.172,12.201,29.172,19.799,24.485,24.485z M23.071,8.929
            	c-3.842-3.842-10.167-3.975-14.142,0c-3.899,3.899-3.899,10.243,0,14.142c3.975,3.975,10.301,3.841,14.142,0
            	C26.97,19.172,26.97,12.828,23.071,8.929z" />
                </svg>
            </div>
        </button>
    </div>
    <div class="overflow-x-auto">
        <div class="bg-zinc-200 rounded-t-lg w-full flex flex-wrap gap-x-2 px-6 py-4">
            <div class="">{{__('ui.field.date')}}</div>
            <div class="">{{__('ui.field.sum')}}</div>
            <div class="">{{__('ui.field.comment')}}</div>
            <div class=""></div>
        </div>
        <div class="bg-white py-4">
            @foreach ( $refillings as $refilling )
            <div x-data="{ open: false }" wire:key="{{ $refilling->id }}" class="px-6 py-4 rounded-lg hover:bg-zinc-100"
                role="accordion">
                <button @click="open=!open" type="button"
                    class="w-full text-base text-left text-gray-800 flex justify-between items-start gap-x-2">
                    <div class="flex flex-wrap gap-x-2">
                        <div class="">{{$refilling->FormatDate}}</div>
                        <div class="">{{$refilling->cost_car_refueling}}</div>
                        <div class="">{{$refilling->comment}}</div>
                    </div>
                    <div class="flex justify-end">
                        <div wire:click="edit({{ $refilling->id }})" title="{{__('ui.btn.edit')}}"
                            class="inline-flex items-center justify-center p-1 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500
                                            dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100
                                            dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" stroke="currentColor" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div wire:click="confirmDelete({{ $refilling->id }})" title="{{__('ui.btn.delete')}}"
                            class="inline-flex items-center justify-center p-1 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500
                                            dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100
                                            dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" stroke="currentColor" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 11V17" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M14 11V17" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M4 7H20" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M6 7H12H18V18C18 19.6569 16.6569 21 15 21H9C7.34315 21 6 19.6569 6 18V7Z"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </div>
                </button>
                <div x-show="open" class="flex justify-between items-center rounded-md">
                    <div class="mr-2 text-xs text-gray-600 leading-relaxed">
                        {{__('ui.field.created')}} {{$refilling->created}},
                        {{__('ui.field.updated')}} {{$refilling->updated}},
                        {{__('ui.field.owner')}} {{$refilling->owner_id}},
                        {{__('ui.field.driver')}} {{$refilling->driver->profile->SurnameInitials}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="px-6 py-4">
        {{ __('ui.text.showing_last_3_records') }}
        <x-nav-link :href="route('refilling.list')" :active="request()->routeIs('refilling.list')" wire:navigate>
            {{ __('ui.text.show_all_records') }}
        </x-nav-link>
    </div>
</div>
