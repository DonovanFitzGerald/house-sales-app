<x-app-layout>
    <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-0">
        {{-- Back link --}}
        <div class="mb-6 flex items-center gap-3">
            <a href="{{ route('houses.show', $house) }}"
                class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path d="m15 19-7-7 7-7" />
                </svg>
                Back
            </a>
        </div>

        {{-- Page header --}}
        <div class="mb-8 rounded-3xl border border-gray-100 bg-white/90 p-6 shadow-sm shadow-gray-200/60">
            <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                <div>
                    <h1 class="text-2xl font-semibold tracking-tight text-gray-900 sm:text-3xl">
                        Assign realtor to
                        <span class="text-gray-700">{{ $house->address_line_1 }}</span>
                    </h1>
                    <p class="mt-2 text-sm text-gray-600">
                        {{ $house->city }}, {{ $house->county }} {{ $house->zip }}
                    </p>
                </div>

                <div class="flex flex-col items-start gap-2 text-sm sm:items-end">
                    <span class="inline-flex items-center rounded-full bg-gray-900 px-3 py-1 text-xs font-medium uppercase tracking-[0.16em] text-white">
                        House admin
                    </span>
                    @if($availableRealtors->count())
                        <p class="text-xs text-gray-500">
                            {{ $availableRealtors->count() }} realtor{{ $availableRealtors->count() === 1 ? '' : 's' }} available
                        </p>
                    @else
                        <p class="text-xs text-red-500">
                            No available realtors to assign
                        </p>
                    @endif
                </div>
            </div>
        </div>

        @if($availableRealtors->count() > 0)
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($availableRealtors as $realtor)
                    @php
                        $isAssigned = in_array($realtor->id, $assignedRealtorIds);
                    @endphp

                    <div
                        class="group overflow-hidden rounded-3xl border border-gray-100 bg-white/95 shadow-sm shadow-gray-200/60 transition hover:-translate-y-0.5 hover:shadow-md">
                        {{-- Avatar --}}
                        <div class="relative aspect-[4/3] w-full overflow-hidden bg-gray-100">
                            <img
                                src="{{ asset('images/users/' . ($realtor->featured_image ?? 'placeholder.jpg')) }}"
                                alt="Portrait of {{ $realtor->name }}"
                                class="h-full w-full object-cover transition duration-300 group-hover:scale-105" />

                            @if($isAssigned)
                                <div class="absolute inset-0 flex items-center justify-center bg-black/45">
                                    <span class="inline-flex items-center gap-2 rounded-full bg-emerald-600/95 px-4 py-1.5 text-xs font-medium text-white shadow-sm">
                                        <span class="inline-block h-2 w-2 rounded-full bg-emerald-300"></span>
                                        Assigned to this house
                                    </span>
                                </div>
                            @endif
                        </div>

                        {{-- Body --}}
                        <div class="flex flex-col gap-4 p-4">
                            <div class="space-y-1.5">
                                <h3 class="truncate text-sm font-semibold text-gray-900" title="{{ $realtor->name }}">
                                    {{ $realtor->name }}
                                </h3>

                                <div class="mt-2 space-y-0.5 text-sm">
                                    <p class="truncate text-gray-700">
                                        <a href="tel:{{ $realtor->phone_number }}"
                                            class="font-medium text-indigo-600 underline-offset-2 hover:text-indigo-700 hover:underline">
                                            {{ $realtor->phone_number }}
                                        </a>
                                    </p>

                                    <p class="truncate text-gray-700">
                                        <a href="mailto:{{ $realtor->email }}"
                                            class="font-medium text-indigo-600 underline-offset-2 hover:text-indigo-700 hover:underline">
                                            {{ $realtor->email }}
                                        </a>
                                    </p>
                                </div>
                            </div>

                            {{-- Actions --}}
                            <div class="mt-2">
                                @if($isAssigned)
                                    <form
                                        action="{{ route('houses.remove-realtor', $house) }}"
                                        method="POST"
                                        class="w-full"
                                        onsubmit="return confirm('Remove this realtor from the house?');">
                                        @csrf
                                        <input type="hidden" name="realtor_id" value="{{ $realtor->id }}">
                                        <button
                                            type="submit"
                                            class="cursor-pointer inline-flex w-full items-center justify-center rounded-full bg-red-600 px-4 py-2 text-xs font-semibold uppercase tracking-[0.16em] text-white shadow-sm transition hover:bg-red-700">
                                            Remove from house
                                        </button>
                                    </form>
                                @else
                                    <form
                                        action="{{ route('houses.assign-realtor', $house) }}"
                                        method="POST"
                                        class="w-full">
                                        @csrf
                                        <input type="hidden" name="realtor_id" value="{{ $realtor->id }}">
                                        <button
                                            type="submit"
                                            class="cursor-pointer inline-flex w-full items-center justify-center rounded-full bg-gray-900 px-4 py-2 text-xs font-semibold uppercase tracking-[0.16em] text-white shadow-sm transition hover:bg-gray-800">
                                            Assign to house
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="rounded-3xl border border-dashed border-gray-200 bg-white/80 p-10 text-center">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M12 5v14m-7-7h14" />
                    </svg>
                </div>
                <h2 class="mt-4 text-base font-semibold text-gray-900">
                    No realtors available
                </h2>
                <p class="mt-2 text-sm text-gray-500">
                    There are currently no unassigned realtors that can be linked to this property.
                </p>
            </div>
        @endif
    </div>
</x-app-layout>
