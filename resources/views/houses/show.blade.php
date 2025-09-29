{{-- resources/views/houses/show.blade.php --}}
@extends('layouts.app')

@section('title', $house->address_line_1 . ', ' . $house->city)

@section('content')
<div class="mx-auto max-w-5xl px-4 py-8">
    {{-- Breadcrumb / Back --}}
    <div class="mb-6">
        <a href="{{ route('houses.index') }}"
           class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900">
            <svg class="mr-2 h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4A1 1 0 018.707 6.293L6.414 8.586H17a1 1 0 110 2H6.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"/></svg>
            Back to listings
        </a>
    </div>

    <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
        {{-- Media / Cover --}}
        <div class="md:col-span-2">
            <div class="overflow-hidden rounded-2xl border">
                {{-- Adjust the image path to your storage/media implementation --}}
                <img
                    src="{{ asset('storage/houses/'.$house->featured_image.'.jpg') }}"
                    onerror="this.src='https://placehold.co/1200x800?text=House+Photo';"
                    alt="Photo of {{ $house->address_line_1 }}, {{ $house->city }}"
                    class="h-80 w-full object-cover md:h-[28rem]">
            </div>
        </div>

        {{-- Summary Card --}}
        <div class="md:col-span-1">
            <div class="rounded-2xl border p-5 shadow-sm">
                <h1 class="mb-1 text-2xl font-semibold">
                    {{ $house->address_line_1 }}
                </h1>
                <p class="text-gray-600">
                    {{ $house->address_line_2 ? $house->address_line_2.', ' : '' }}
                    {{ $house->city }}, {{ $house->county }} {{ $house->zip }}
                </p>

                <div class="my-4 h-px w-full bg-gray-200"></div>

                {{-- Quick facts --}}
                <ul class="space-y-2 text-sm text-gray-700">
                    <li>
                        <span class="font-medium">Type:</span>
                        <span class="ml-1 capitalize">{{ $house->house_type }}</span>
                    </li>
                    <li>
                        <span class="font-medium">Size:</span>
                        <span class="ml-1">{{ number_format($house->square_metres) }} m²</span>
                    </li>
                    <li>
                        <span class="font-medium">Beds:</span>
                        <span class="ml-1">{{ $house->beds }}</span>
                    </li>
                    <li>
                        <span class="font-medium">Baths:</span>
                        <span class="ml-1">{{ $house->baths }}</span>
                    </li>
                    <li class="flex items-center">
                        <span class="mr-2 font-medium">BER:</span>
                        @php
                            $badge = match($house->energy_rating) {
                                'A1','A2','A3' => 'bg-emerald-100 text-emerald-800 ring-emerald-200',
                                'B1','B2','B3' => 'bg-lime-100 text-lime-800 ring-lime-200',
                                'C1','C2','C3' => 'bg-yellow-100 text-yellow-800 ring-yellow-200',
                                'D1','D2'      => 'bg-amber-100 text-amber-800 ring-amber-200',
                                'E1','E2'      => 'bg-orange-100 text-orange-800 ring-orange-200',
                                'F','G'        => 'bg-red-100 text-red-800 ring-red-200',
                                default        => 'bg-gray-100 text-gray-800 ring-gray-200',
                            };
                        @endphp
                        <span class="rounded-full px-2.5 py-0.5 text-xs font-semibold ring-1 {{ $badge }}">
                            {{ $house->energy_rating }}
                        </span>
                    </li>
                </ul>

                <div class="mt-6 flex gap-3">
                    @can('update', $house)
                    <a href="{{ route('houses.edit', $house) }}"
                       class="inline-flex items-center rounded-lg border bg-white px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Edit
                    </a>
                    @endcan
                    <a href="https://maps.google.com/?q={{ urlencode($house->address_line_1.' '.$house->address_line_2.' '.$house->city.' '.$house->county.' '.$house->zip) }}"
                       target="_blank"
                       class="inline-flex items-center rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white hover:bg-black/90">
                        View on Map
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Description --}}
    <div class="mt-10 grid grid-cols-1 gap-8 md:grid-cols-3">
        <div class="md:col-span-2">
            <h2 class="mb-3 text-xl font-semibold">Description</h2>
            <div class="prose max-w-none">
                <p>{{ $house->description }}</p>
            </div>
        </div>

        {{-- Details list --}}
        <div class="md:col-span-1">
            <h2 class="mb-3 text-xl font-semibold">Property Details</h2>
            <dl class="divide-y rounded-2xl border">
                <div class="grid grid-cols-3 gap-2 px-4 py-3">
                    <dt class="col-span-1 text-sm text-gray-500">Address 1</dt>
                    <dd class="col-span-2 text-sm">{{ $house->address_line_1 }}</dd>
                </div>
                <div class="grid grid-cols-3 gap-2 px-4 py-3">
                    <dt class="col-span-1 text-sm text-gray-500">Address 2</dt>
                    <dd class="col-span-2 text-sm">{{ $house->address_line_2 }}</dd>
                </div>
                <div class="grid grid-cols-3 gap-2 px-4 py-3">
                    <dt class="col-span-1 text-sm text-gray-500">City</dt>
                    <dd class="col-span-2 text-sm">{{ $house->city }}</dd>
                </div>
                <div class="grid grid-cols-3 gap-2 px-4 py-3">
                    <dt class="col-span-1 text-sm text-gray-500">County</dt>
                    <dd class="col-span-2 text-sm">{{ $house->county }}</dd>
                </div>
                <div class="grid grid-cols-3 gap-2 px-4 py-3">
                    <dt class="col-span-1 text-sm text-gray-500">Postcode</dt>
                    <dd class="col-span-2 text-sm">{{ $house->zip }}</dd>
                </div>
                <div class="grid grid-cols-3 gap-2 px-4 py-3">
                    <dt class="col-span-1 text-sm text-gray-500">Type</dt>
                    <dd class="col-span-2 text-sm capitalize">{{ $house->house_type }}</dd>
                </div>
                <div class="grid grid-cols-3 gap-2 px-4 py-3">
                    <dt class="col-span-1 text-sm text-gray-500">BER</dt>
                    <dd class="col-span-2 text-sm">{{ $house->energy_rating }}</dd>
                </div>
                <div class="grid grid-cols-3 gap-2 px-4 py-3">
                    <dt class="col-span-1 text-sm text-gray-500">Area</dt>
                    <dd class="col-span-2 text-sm">{{ number_format($house->square_metres) }} m²</dd>
                </div>
                <div class="grid grid-cols-3 gap-2 px-4 py-3">
                    <dt class="col-span-1 text-sm text-gray-500">Bedrooms</dt>
                    <dd class="col-span-2 text-sm">{{ $house->beds }}</dd>
                </div>
                <div class="grid grid-cols-3 gap-2 px-4 py-3">
                    <dt class="col-span-1 text-sm text-gray-500">Bathrooms</dt>
                    <dd class="col-span-2 text-sm">{{ $house->baths }}</dd>
                </div>
            </dl>
        </div>
    </div>

    {{-- Footer actions --}}
    <div class="mt-10 flex flex-wrap items-center gap-3">
        <a href="{{ route('houses.index') }}"
           class="inline-flex items-center rounded-lg border bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
            Back to listings
        </a>
        @can('delete', $house)
        <form action="{{ route('houses.destroy', $house) }}" method="POST" onsubmit="return confirm('Delete this house?');">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="inline-flex items-center rounded-lg bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700">
                Delete
            </button>
        </form>
        @endcan
    </div>
</div>
@endsection
