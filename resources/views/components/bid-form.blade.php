@props([
'action' => '#',
'method' => 'POST',
'house' => null,
'submitLabel' => 'Save',
])

<form action="{{ $action }}" method="POST" enctype="multipart/form-data"
    {{ $attributes->merge(['class' => 'space-y-6']) }}>
    @csrf
    @if($method === 'PUT' || $method === 'PATCH')
    @method($method)
    @endif

    <div>
        <label class="block text-sm font-medium text-gray-700">Bid Amount</label>
        <input type="number" min="0" name="value" value="{{ $val('value', 0) }}"
            class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-300">
        @error('value')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>


    <div class="flex items-center justify-end gap-3">
        <a href="{{ url()->previous() }}"
            class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-800 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300">
            Cancel
        </a>
        <button type="submit"
            class="inline-flex items-center rounded-lg bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-400">
            Place Bid
        </button>
    </div>
</form>