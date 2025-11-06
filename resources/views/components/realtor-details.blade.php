@props(['realtor'])

@php
$avatar = $realtor->featured_image_url
?? asset('images/users/' . ($realtor->featured_image ?: 'default.jpg'));
@endphp

<section class="">
    {{-- Breadcrumbs --}}
    <nav class="mb-4 text-sm text-gray-500">
        <a href="{{ route('realtors.index') }}" class="hover:text-gray-700">Realtors</a>
        <span class="mx-2">/</span>
        <span class="text-gray-900">{{ $realtor->name }}</span>
    </nav>

    <div class="rounded-2xl border border-gray-200 bg-white shadow-sm grid grid-cols-[2fr_1fr] overflow-hidden">
        {{-- Hero image --}}
        <div class="relative aspect-[16/9] w-full bg-gray-100">
            <img src="{{ $avatar }}" alt="Portrait of {{ $realtor->name }}" class="h-full w-full object-cover">
            <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/55 to-transparent p-4">
                <h1 class="text-xl font-semibold text-white drop-shadow">{{ $realtor->name }}</h1>
            </div>
        </div>

        {{-- Main content --}}
        <div class="p-6 lg:p-8">
            {{-- Quick details --}}
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="space-y-1">
                    <p class="text-sm text-gray-600">Phone Number</p>
                    <p class="text-sm font-medium text-gray-900">
                        <a href="mailto:{{ $realtor->phone_number }}"
                            class="text-indigo-600 hover:text-indigo-700 hover:underline">
                            {{ $realtor->phone_number }}
                        </a>
                    </p>
                    <p class="text-sm text-gray-600">Email</p>
                    <p class="text-sm font-medium text-gray-900">
                        <a href="mailto:{{ $realtor->email }}"
                            class="text-indigo-600 hover:text-indigo-700 hover:underline">
                            {{ $realtor->email }}
                        </a>
                    </p>
                </div>

                {{-- “Realtor” chip --}}
                <span
                    class="inline-flex items-center self-start rounded-full bg-gray-50 px-3 py-1 text-xs font-medium text-gray-700 ring-1 ring-inset ring-gray-200">
                    Realtor
                </span>
            </div>

            {{-- Optional bio --}}
            @if(!empty($realtor->bio ?? null))
            <div class="mt-6">
                <h2 class="text-base font-semibold text-gray-900">About {{ $realtor->name }}</h2>
                <p class="mt-2 leading-relaxed text-gray-700">{{ $realtor->bio }}</p>
            </div>
            @endif

            {{-- Actions --}}
            <div class="mt-8 grid gap-2">
                <a href="mailto:{{ $realtor->email }}"
                    class="inline-flex items-center justify-center rounded-lg bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-400">
                    Contact {{ $realtor->name }}
                </a>
            </div>
        </div>
    </div>
</section>