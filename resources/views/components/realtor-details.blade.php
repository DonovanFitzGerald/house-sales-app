@props(['realtor'])

@php
$name = $realtor->name ?? '';
$email = $realtor->email ?? '';
$avatar = $realtor->featured_image_url
?? asset('images/users/' . ($realtor->featured_image ?: 'default.jpg'));
@endphp

<section class="">
    {{-- Breadcrumbs --}}
    <nav class="mb-4 text-sm text-gray-500">
        <a href="{{ route('realtors.index') }}" class="hover:text-gray-700">Realtors</a>
        <span class="mx-2">/</span>
        <span class="text-gray-900">{{ $name }}</span>
    </nav>

    <div class="rounded-2xl border border-gray-200 bg-white shadow-sm">
        {{-- Hero image --}}
        <div class="relative aspect-[16/9] w-full overflow-hidden rounded-t-2xl bg-gray-100">
            <img src="{{ $avatar }}" alt="Portrait of {{ $name }}"
                onerror="this.onerror=null;this.src='{{ asset('images/users/default.jpg') }}';"
                class="h-full w-full object-cover">
            <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/55 to-transparent p-4">
                <h1 class="text-xl font-semibold text-white drop-shadow">{{ $name }}</h1>
            </div>
        </div>

        {{-- Main content --}}
        <div class="p-6 lg:p-8">
            {{-- Quick details --}}
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="space-y-1">
                    <p class="text-sm text-gray-600">Email</p>
                    <p class="text-sm font-medium text-gray-900">
                        <a href="mailto:{{ $email }}" class="text-indigo-600 hover:text-indigo-700 hover:underline">
                            {{ $email }}
                        </a>
                    </p>
                </div>

                {{-- Optional small “Realtor” chip --}}
                <span
                    class="inline-flex items-center self-start rounded-full bg-gray-50 px-3 py-1 text-xs font-medium text-gray-700 ring-1 ring-inset ring-gray-200">
                    Realtor
                </span>
            </div>

            {{-- Optional bio (render only if present) --}}
            @if(!empty($realtor->bio ?? null))
            <div class="mt-6">
                <h2 class="text-base font-semibold text-gray-900">About {{ $name }}</h2>
                <p class="mt-2 leading-relaxed text-gray-700">{{ $realtor->bio }}</p>
            </div>
            @endif

            {{-- Actions --}}
            <div class="mt-8 grid grid-cols-2 gap-2 sm:w-1/2">
                <a href="{{ route('realtors.index') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Back to list
                </a>
                <a href="mailto:{{ $email }}"
                    class="inline-flex items-center justify-center rounded-lg bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-400">
                    Contact {{ $name }}
                </a>
            </div>
        </div>
    </div>
</section>