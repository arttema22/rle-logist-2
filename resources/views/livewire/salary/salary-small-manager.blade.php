<div class="relative mx-auto  bg-zinc-100 overflow-hidden border rounded-t-lg">
    <div class="flex justify-between px-6 py-4">
        {{__('ui.title.salaries')}}
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
            @foreach ( $salaries as $salary )
            <div x-data="{ open: false }" wire:key="{{ $salary->id }}" class="px-6 py-4 rounded-lg hover:bg-zinc-100"
                role="accordion">
                <button @click="open=!open" type="button"
                    class="w-full text-base text-left text-gray-800 flex justify-between items-start gap-x-2">
                    <div class="flex flex-wrap gap-x-2">
                        <div class="">{{$salary->FormatDate}}</div>
                        <div class="">{{$salary->salary}}</div>
                        <div class="">{{$salary->comment}}</div>
                    </div>
                    <div class="flex justify-end">
                        <div wire:click="edit({{ $salary->id }})" title="{{__('ui.btn.edit')}}"
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
                        <div wire:click="confirmDelete({{ $salary->id }})" title="{{__('ui.btn.delete')}}"
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
                        {{__('ui.field.created')}} {{$salary->created}},
                        {{__('ui.field.updated')}} {{$salary->updated}},
                        {{__('ui.field.owner')}} {{$salary->owner_id}},
                        {{__('ui.field.driver')}} {{$salary->driver->profile->SurnameInitials}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="px-6 py-4">
        {{ __('ui.text.showing_last_3_records') }}
        <x-nav-link :href="route('salary.list')" :active="request()->routeIs('salary.list')" wire:navigate>
            {{ __('ui.text.show_all_records') }}
        </x-nav-link>
    </div>

    @if($isOpenForm)
    <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true">
        </div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="text-center sm:text-left">
                            <h3 class="text-base font-semibold text-gray-900" id="modal-title">
                                {{($createOrUpdate) ? __('ui.title.edit_salary') : __('ui.title.create_new_salary')}}
                            </h3>
                            <div class="mt-2">
                                {{-- <div class="mt-4">
                                    <label class="text-gray-800 text-sm mb-2 block">{{__('ui.field.date')}}</label>
                                <input wire:model="date" name="date" type="date" required autofocus autocomplete="date"
                                    class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-lg outline-blue-600"
                                    placeholder="{{__('ui.field.enter_date')}}" />
                                <div class="text-red-600">@error('date') {{ $message }} @enderror</div>
                            </div> --}}
                            <div class="mt-4">
                                <label class="text-gray-800 text-sm mb-2 block">{{__('Sum')}}</label>
                                <input wire:model="sum" name="sum" type="number" min="10" max="1000000" step=".01"
                                    required autocomplete="sum"
                                    class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-lg outline-blue-600"
                                    placeholder="{{__('Enter sum')}}" />
                                <div class="text-red-600">@error('sum') {{ $message }} @enderror</div>
                            </div>
                            <div class="mt-4">
                                <label class="text-gray-800 text-sm mb-2 block">{{__('Comment')}}</label>
                                <input wire:model="comment" name="comment" type="text" autocomplete="comment"
                                    class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-lg outline-blue-600"
                                    placeholder="{{__('Enter comment')}}" />
                                <div class="text-red-600">@error('comment') {{ $message }} @enderror</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button wire:click="store" type="button"
                        class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Save</button>
                    <button wire:click="toggle" type="button"
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">{{__('Cancel')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<div wire:loading class="flex justify-center items-center absolute bottom-1 left-1">
    <svg xmlns="http://www.w3.org/2000/svg" class="spinner-8 w-10 h-10 shrink-0 animate-spin"
        viewBox="0 0 122.88 122.88">
        <path
            d="M61.44,21.74c10.96,0,20.89,4.44,28.07,11.63c7.18,7.18,11.63,17.11,11.63,28.07c0,10.96-4.44,20.89-11.63,28.07 c-7.18,7.18-17.11,11.63-28.07,11.63c-10.96,0-20.89-4.44-28.07-11.63c-7.18-7.18-11.63-17.11-11.63-28.07 c0-10.96,4.44-20.89,11.63-28.07C40.55,26.19,50.48,21.74,61.44,21.74L61.44,21.74z M61.44,0c16.97,0,32.33,6.88,43.44,18 c11.12,11.12,18,26.48,18,43.44c0,16.97-6.88,32.33-18,43.44c-11.12,11.12-26.48,18-43.44,18c-16.97,0-32.33-6.88-43.44-18 C6.88,93.77,0,78.41,0,61.44C0,44.47,6.88,29.11,18,18C29.11,6.88,44.47,0,61.44,0L61.44,0z M93.47,29.41 c-8.2-8.2-19.52-13.27-32.03-13.27c-12.51,0-23.83,5.07-32.03,13.27c-8.2,8.2-13.27,19.52-13.27,32.03 c0,12.51,5.07,23.83,13.27,32.03c8.2,8.2,19.52,13.27,32.03,13.27c12.51,0,23.83-5.07,32.03-13.27c8.2-8.2,13.27-19.52,13.27-32.03 C106.74,48.93,101.67,37.61,93.47,29.41L93.47,29.41z M65.45,56.77c-1.02-1.02-2.43-1.65-4.01-1.65c-1.57,0-2.99,0.63-4.01,1.65 l-0.01,0.01c-1.02,1.02-1.65,2.43-1.65,4.01c0,1.57,0.63,2.99,1.65,4.01l0.01,0.01c1.02,1.02,2.43,1.65,4.01,1.65 c1.57,0,2.99-0.63,4.01-1.65l0.01-0.01c1.02-1.02,1.65-2.44,1.65-4.01C67.1,59.21,66.47,57.8,65.45,56.77L65.45,56.77L65.45,56.77z M65.06,50.79c1.47,0.54,2.8,1.39,3.89,2.48l0,0l0,0c0.37,0.37,0.72,0.77,1.03,1.2l0.1-0.03l21.02-5.63 c-1.63-3.83-3.98-7.28-6.88-10.17c-5.03-5.03-11.72-8.41-19.17-9.24v21.12C65.07,50.61,65.07,50.7,65.06,50.79L65.06,50.79z M72.04,61.63c-0.14,1.73-0.69,3.35-1.57,4.76c0.05,0.06,0.09,0.13,0.13,0.2l12.07,19.13c0.54-0.47,1.06-0.96,1.57-1.47 c5.83-5.83,9.44-13.9,9.44-22.8c0-1.87-0.16-3.7-0.47-5.49L72.04,61.63L72.04,61.63z M64.57,70.95c-0.99,0.31-2.04,0.47-3.13,0.47 c-0.98,0-1.93-0.13-2.84-0.38L46.82,90.19c4.39,2.24,9.36,3.5,14.62,3.5c5.46,0,10.6-1.36,15.11-3.75L64.57,70.95L64.57,70.95z M52.57,66.64c-0.92-1.38-1.52-2.99-1.7-4.71l-0.01,0l-21.09-6.6c-0.38,1.98-0.58,4.02-0.58,6.11c0,8.9,3.61,16.97,9.44,22.8 c0.63,0.63,1.29,1.24,1.98,1.82l11.8-19.19C52.47,66.8,52.52,66.72,52.57,66.64L52.57,66.64z M52.72,54.72 c0.36-0.51,0.76-1,1.21-1.44l0,0l0,0c1.05-1.04,2.31-1.87,3.71-2.41c-0.01-0.11-0.02-0.23-0.02-0.34v-21.1 c-7.38,0.87-14,4.23-18.98,9.22c-2.75,2.75-5.01,6-6.63,9.6L52.72,54.72L52.72,54.72z" />
    </svg>
</div>

</div>
