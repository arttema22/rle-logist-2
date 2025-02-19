<div>
    <x-header.header>
        {{__('Salaries')}}
    </x-header.header>

    {{-- @livewire('Salary.SalarySmallManager') --}}

    <div class="relative mx-auto  bg-gray-100 overflow-hidden border sm:rounded-lg p-4">
        <div class="w-full flex px-6 py-1">
            <div class="w-1/3">{{__('Date')}}</div>
            <div class="w-1/3">{{__('Sum')}}</div>
            <div class="w-1/3">{{__('Comment')}}</div>
        </div>
        <div class="space-y-2">
            @foreach ( $salaries as $salary )
            <div x-data="{ open: false }" wire:key="{{ $salary->id }}"
                class="bg-white shadow-[0_2px_4px_0px_rgba(0,0,0,0.15)] px-6 py-3 rounded-md" role="accordion">
                <button @click="open=!open" type="button"
                    class="w-full text-base text-left text-gray-800 flex items-center transition-all">
                    <div class="w-1/3">{{$salary->driver->name}}</div>
                    <div class="w-1/3">{{$salary->date}}</div>
                    <div class="w-1/3">{{$salary->salary}}</div>

                    <x-moonshine::field-container label="Sum">
                        <x-moonshine::form.input type="text" name="$salary->comment" />
                    </x-moonshine::field-container>

                    <div class="w-1/3">{{$salary->comment}}</div>
                </button>
                <div x-show="open" class="flex justify-between items-center border-t">
                    <div class="mr-2 text-xs text-gray-600 leading-relaxed">


                        <!-- Timeline -->
                        <div>
                            {{-- @foreach ( $salary->log as $log )
                            @if ($log)
                            <!-- Item -->
                            <div class="flex gap-x-3">
                                <!-- Left Content -->
                                <div class="w-16 text-end">
                                    <span class="text-xs text-gray-500">
                                        {{$log->created_at->format(config('app.date_full_format'))}}
                            </span>
                        </div>
                        <!-- End Left Content -->
                        <!-- Icon -->
                        <div
                            class="relative last:after:hidden after:absolute after:top-7 after:bottom-0 after:start-3.5 after:w-px after:-translate-x-[0.5px] after:bg-gray-200">
                            <div class="relative z-10 size-7 flex justify-center items-center">
                                <div class="size-2 rounded-full bg-gray-400"></div>
                            </div>
                        </div>
                        <!-- End Icon -->
                        <!-- Right Content -->
                        <div class="grow pt-0.5 pb-8">
                            <h3 class="flex gap-x-1.5 font-semibold text-gray-800">
                                {{$log->event}}
                            </h3>
                            <div>
                                {{$log->properties->attributes->sum}}
                            </div>
                            <p class="mt-1 text-sm text-gray-600">
                                {{-- {{$log->properties}} --}}
                                {{-- </p>
                        </div>
                        <!-- End Right Content -->
                    </div>
                    <!-- End Item -->
                    @endif
                    @endforeach --}}
                        </div>
                        <!-- End Timeline -->
                        <div class="flex gap-2">
                            <button wire:click="edit({{ $salary->id }})">edit</button>
                            <button wire:click="confirmDelete({{ $salary->id }})">delete</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>