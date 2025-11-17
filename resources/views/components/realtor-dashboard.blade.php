@php
    $realtor = Auth::user();
    $houses = $realtor->houses;
@endphp
<div class="flex flex-col gap-4">
    <div class="rounded-2xl border border-gray-200 bg-white shadow-sm px-6 py-4">
        <h1 class="text-xl font-semibold text-gray-900 ">Your Listings</h1>
    </div>
    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($houses as $house)
            <x-house-card :house="$house" />
        @endforeach
    </div>
</div>