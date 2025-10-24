<x-app-layout>
    <div class="mx-auto max-w-6xl px-4 py-6">
        <div class="mb-4 flex items-center gap-3">
            <a href="{{ route('houses.index') }}"
                class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path d="m15 19-7-7 7-7" />
                </svg>
                Back
            </a>
        </div>

        <x-house-details :house="$house" />
    </div>
</x-app-layout>