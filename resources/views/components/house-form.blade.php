@props([
'action' => '#',
'method' => 'POST',
'house' => null,
'submitLabel' => 'Save',
])

@php

// Options for selects
$ratings = ['A1','A2','A3','B1','B2','B3','C1','C2','C3','D1','D2','E1','E2','F','G'];
$types = ['detatched','semi-detached','terraced','bungalow','apartment','studio'];

// Helper to get old value or house value
$val = fn($k) => old($k, $house?->$k);

// Get current house image
$existingImageUrl = null;
if ($house?->featured_image_url ?? false) {
$existingImageUrl = $house->featured_image_url;
} elseif ($house?->featured_image) {
$existingImageUrl = asset('images/houses/'.$house->featured_image);
}
@endphp

<form action="{{ $action }}" method="POST" enctype="multipart/form-data"
    {{ $attributes->merge(['class' => 'space-y-6']) }}>
    @csrf
    @if($method === 'PUT' || $method === 'PATCH')
    @method($method)
    @endif

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

        <div>
            <label class="block text-sm font-medium text-gray-700">Address line 1</label>
            <input type="text" name="address_line_1" value="{{ $val('address_line_1') }}"
                class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-300">
            @error('address_line_1')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Address line 2</label>
            <input type="text" name="address_line_2" value="{{ $val('address_line_2') }}"
                class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-300">
            @error('address_line_2')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">City</label>
            <input type="text" name="city" value="{{ $val('city') }}"
                class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-300">
            @error('city')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">County</label>
            <input type="text" name="county" value="{{ $val('county') }}"
                class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-300">
            @error('county')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">ZIP</label>
            <input type="text" name="zip" value="{{ $val('zip') }}"
                class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-300">
            @error('zip')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Beds</label>
            <input type="number" min="0" name="beds" value="{{ $val('beds', 0) }}"
                class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-300">
            @error('beds')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Baths</label>
            <input type="number" min="0" name="baths" value="{{ $val('baths', 0) }}"
                class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-300">
            @error('baths')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Square metres</label>
            <input type="number" min="0" name="square_metres" value="{{ $val('square_metres', 0) }}"
                class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-300">
            @error('square_metres')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Energy rating</label>
            <select name="energy_rating"
                class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-300">
                <option value="" disabled {{ $val('energy_rating') ? '' : 'selected' }}>Select…</option>
                @foreach($ratings as $r)
                <option value="{{ $r }}" @selected($val('energy_rating')===$r)>{{ $r }}</option>
                @endforeach
            </select>
            @error('energy_rating')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">House type</label>
            <select name="house_type"
                class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-300">
                <option value="" disabled {{ $val('house_type') ? '' : 'selected' }}>Select…</option>
                @foreach($types as $t)
                <option value="{{ $t }}" @selected($val('house_type')===$t)>
                    {{ $t }}</option>
                @endforeach
            </select>
            @error('house_type')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" rows="4"
                class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-300">{{ $val('description') }}</textarea>
            @error('description')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700">Featured image</label>

            <div class="mt-2 flex items-start gap-4">
                <div class="h-32 w-48 overflow-hidden rounded-lg border border-gray-200 bg-gray-50">
                    <img id="featured_preview" src="{{ $existingImageUrl ?? '' }}" alt="Preview"
                        class="h-full w-full object-cover {{ $existingImageUrl ? '' : 'hidden' }}">
                </div>

                <div class="flex-1 ">
                    <input id="featured_input" type="file" name="featured_image" accept="image/*"
                        class="mt-1 block w-full cursor-pointer rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm file:mr-4 file:rounded-md file:border-0 file:bg-gray-900 file:px-3 file:py-2 file:text-sm file:font-medium file:text-white hover:file:bg-gray-800 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-300">
                    @error('featured_image')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror

                    <button type="button" id="featured_reset"
                        class="cursor-pointer mt-2 inline-flex items-center rounded-md border border-gray-300 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-50">
                        Reset image
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="flex items-center justify-end gap-3">
        <a href="{{ url()->previous() }}"
            class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-800 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300">
            Cancel
        </a>
        <button type="submit"
            class="inline-flex items-center rounded-lg bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-400">
            {{ $submitLabel }}
        </button>
    </div>
</form>

<!-- Preview script -->
<script>
// Wait for DOM to load
document.addEventListener('DOMContentLoaded', () => {
    // Get elements
    const input = document.querySelector('#featured_input');
    const img = document.querySelector('#featured_preview');
    const reset = document.querySelector('#featured_reset');
    const initial = @json($existingImageUrl ?? '');

    if (!input || !img) return;

    // Set img src
    function showPreview(file) {
        if (!file) return;
        const url = URL.createObjectURL(file);
        img.src = url;
        img.classList.remove('hidden');
        img.onload = () => URL.revokeObjectURL(url);
    }

    // Listen for file input change
    input.addEventListener('change', (e) => {
        const file = e.target.files && e.target.files[0];
        if (file) showPreview(file);
    });

    // Listen for reset button click
    reset.addEventListener('click', () => {
        input.value = '';
        if (initial) {
            img.src = initial;
            img.classList.remove('hidden');
        } else {
            img.removeAttribute('src');
            img.classList.add('hidden');
        }
    });

    // Show initial image
    if (initial) {
        img.src = initial;
        img.classList.remove('hidden');
    } else {
        img.classList.add('hidden');
    }
});
</script>