<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Your Bids') }}
    </h2>
</x-slot>
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-6">
    <div class="grid grid-cols-3 gap-6">
        @foreach (Auth::user()->housesBidOn as $house)
            <x-house-card :house="$house"/>
        @endforeach
    </div>
</div>