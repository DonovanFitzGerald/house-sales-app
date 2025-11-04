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

        <section class="mt-8">
            <h2 class="mb-4 text-base font-semibold text-gray-900">Listing Realtors</h2>
            @if($realtors && $realtors->count())
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">

                @foreach($realtors as $realtor)
                <x-realtor-card :realtor="$realtor" />
                @endforeach

            </div>
            @else
            <p class="text-sm text-gray-600">No realtors assigned yet.</p>
            @endif
        </section>
    </div>
</x-app-layout>