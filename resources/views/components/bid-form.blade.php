@props([
'action' => '#',
'method' => 'POST',
'bid' => null,
'submitLabel' => 'Save',
'house' => null
])

@php
$val = fn($k) => old($k, $bid?->$k);
dd($house);
@endphp

<form action="{{ $action }}" method="POST" enctype="multipart/form-data" {{ $attributes->merge([
        'class' =>
            'space-y-6 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-900',
    ]) }}>
    @csrf
    @if($method === 'PUT' || $method === 'PATCH')
    @method($method)
    @endif

    <input type="hidden" name="house" value="{{ $house }}">

    <div>
        <label for="bid_value" class="block text-sm font-medium text-gray-800 dark:text-gray-100">
            Bid amount
        </label>

        <div class="relative mt-1">
            <span
                class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-sm text-gray-400 dark:text-gray-500">
                €
            </span>

            <input id="bid_value" type="number" min="0" step="1" name="value" value="{{ $val('value') }}"
                class="block w-full rounded-xl border border-gray-300 bg-white px-3 py-2 pl-8 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-300  dark:border-gray-700 dark:bg-gray-950 dark:text-gray-100 dark:focus:border-indigo-400 dark:focus:ring-indigo-500"
                placeholder="Enter your bid" />
        </div>

        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
            Enter the amount you’d like to bid for this property.
        </p>

        @error('value')
        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center justify-end gap-3">
        <a href="{{ url()->previous() }}"
            class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-800 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 dark:hover:bg-gray-800 dark:focus:ring-gray-600">
            Cancel
        </a>

        <button type="submit"
            class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-400 dark:bg-indigo-500 dark:hover:bg-indigo-400 dark:focus:ring-indigo-300">
            {{ $submitLabel }}
        </button>
    </div>
</form>