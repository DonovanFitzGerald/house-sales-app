@props(['realtor'])

<article class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition hover:shadow-md">
    <div class="relative aspect-[4/3] w-full overflow-hidden bg-gray-100">
        <img src="{{ asset('images/users/' . ($realtor->featured_image ?? 'placeholder.jpg')) }}"
            alt="Portrait of {{ $realtor->name }}"
            class="h-full w-full object-cover transition duration-300 hover:scale-[1.02]" />
    </div>

    <div class="p-4">
        <h3 class="truncate text-sm font-semibold text-gray-900" title="{{ $realtor->name }}">
            {{ $realtor->name }}
        </h3>

        <p class="mt-1 truncate text-sm text-gray-600" title="{{ $realtor->email }}">
            <a href="tel:{{ $realtor->phone_number }}" class="text-indigo-600 hover:text-indigo-700 hover:underline">
                {{ $realtor->phone_number }}
            </a>
        </p>

        <p class="mt-1 truncate text-sm text-gray-600" title="{{ $realtor->email }}">
            <a href="mailto:{{ $realtor->email }}" class="text-indigo-600 hover:text-indigo-700 hover:underline">
                {{ $realtor->email }}
            </a>
        </p>
    </div>
</article>