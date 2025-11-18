@props(['bid'])


@php
    $user = $bid->user ?? null;
    $avatar = $user && $user->featured_image
        ? asset('images/users/' . $user->featured_image)
        : asset('images/users/default.jpg');

    // Fallbacks
    $name = $user->name ?? 'Unknown bidder';
    $email = $user->email ?? null;
    $phone = $user->phone_number ?? null;

    // Format money (Euro by default)
    $amount = '€' . number_format($bid->value, 0);
    $when = optional($bid->created_at)->diffForHumans() ?? '—';
@endphp

<article
    class="flex flex-col overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition hover:shadow-md">
    {{-- Header --}}
    <div class="flex items-center gap-3 p-4">
        <img src="{{ $avatar }}" alt="{{ $name }}" class="h-12 w-12 rounded-full object-cover"
            onerror="this.onerror=null;this.src='{{ asset('images/users/default.jpg') }}'">
        <div class="min-w-0">
            <h3 class="truncate text-sm font-semibold text-gray-900" title="{{ $name }}">{{ $name }}</h3>
            @if($email)
                <p class="truncate text-xs text-gray-600">
                    <a href="mailto:{{ $email }}"
                        class="text-indigo-600 hover:text-indigo-700 hover:underline">{{ $email }}</a>
                </p>
            @endif
            @if($phone)
                <p class="truncate text-xs text-gray-500">{{ $phone }}</p>
            @endif
        </div>
    </div>

    {{-- Body --}}
    <div class="flex flex-1 items-center justify-between border-t border-gray-100 px-4 py-3">
        <div class="flex flex-col">
            <span class="text-xs text-gray-500">Bid Amount</span>
            <span class="text-lg font-semibold text-gray-900">{{ $amount }}</span>
        </div>
        <div class="text-right">
            <span class="text-xs text-gray-500">Placed</span>
            <div class="text-sm text-gray-700">{{ $when }}</div>
        </div>
    </div>

    {{-- Footer (optional actions) --}}
    <div class="flex justify-between gap-2 border-t border-gray-100 px-4 py-3">
        @if(Auth::user()->role == 'admin')
            <div class=" flex space-x-2">
                <a href="{{ route('bids.edit', $bid) }}"
                    class="text-white bg-orange-500 hover:bg-orange-700 font-bold h-full px-4 rounded text-center flex items-center">
                    <p>Edit</p>
                </a>
                <form action="{{ route('bids.destroy', $bid) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this bid?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-500 cursor-pointer hover:bg-red-700 text-white font-bold h-full px-4 rounded">
                        Delete
                    </button>
                </form>
            </div>
        @endif
        @if($email)
            <a href="mailto:{{ $email }}"
                class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-xs font-medium text-gray-900 hover:bg-gray-50">
                Contact bidder
            </a>
        @endif
    </div>
</article>
{{-- Admin actions --}}