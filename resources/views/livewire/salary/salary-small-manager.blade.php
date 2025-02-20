<div>
    <div class="w-full flex px-6 py-1">
        <div class="w-1/3">{{__('date')}}</div>
        <div class="w-1/3">{{__('sum')}}</div>
        <div class="w-1/3">{{__('comment')}}</div>
    </div>
    <div class="space-y-2">
        @foreach ( $salaries as $salary )
        <div x-data="{ open: false }" wire:key="{{ $salary->id }}"
            class="bg-white shadow-[0_2px_4px_0px_rgba(0,0,0,0.15)] px-6 py-3 rounded-md" role="accordion">
            <div class="w-full text-base text-left text-gray-800 flex items-center transition-all">
                <div class="w-1/3">{{$salary->FormatDate}}</div>
                <div class="w-1/3">{{$salary->salary}}</div>
                <div class="w-1/3 overflow-auto">{{$salary->comment}}</div>
            </div>
        </div>
        @endforeach
    </div>
</div>