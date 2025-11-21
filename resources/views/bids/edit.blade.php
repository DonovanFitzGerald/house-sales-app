<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Bid') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-bid-form action="{{ route('bids.update', $bid) }}" method="PUT" :bid="$bid" />
        </div>
    </div>
</x-app-layout>