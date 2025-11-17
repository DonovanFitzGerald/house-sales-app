@props(['realtor'])
<div>
    <article class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition hover:shadow-md">
        <a href="{{ route('realtors.show', $realtor) }}" class="group block focus:outline-none">
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
                    <a href="tel:{{ $realtor->phone_number }}"
                        class="text-indigo-600 hover:text-indigo-700 hover:underline">
                        {{ $realtor->phone_number }}
                    </a>
                </p>

                <p class="mt-1 truncate text-sm text-gray-600" title="{{ $realtor->email }}">
                    <a href="mailto:{{ $realtor->email }}"
                        class="text-indigo-600 hover:text-indigo-700 hover:underline">
                        {{ $realtor->email }}
                    </a>
                </p>
            </div>
        </a>
    </article>

    {{-- Admin actions --}}
    @if(Auth::user()->role == 'admin')
        <div class="mt-4 flex space-x-2">
            <a href="{{ route('realtors.edit', $realtor) }}"
                class="text-white bg-orange-500 hover:bg-orange-700 font-bold py-2 px-4 rounded">
                Edit
            </a>
            <form action="{{ route('realtors.destroy', $realtor) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this realtor?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="bg-red-500 cursor-pointer hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    Delete
                </button>
            </form>
        </div>
    @endif
</div>