<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Bid') }}
        </h2>
    </x-slot>

    <div class="mt-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <x-bid-form action="{{ route('houses.bids.store', $house) }}" method="POST" />
    </div>
</x-app-layout>