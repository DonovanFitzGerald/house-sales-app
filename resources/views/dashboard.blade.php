<x-app-layout>
    {{-- Render Different Dashboards based on user role --}}
    @switch(Auth::user()->role)
            @case('admin')
            <x-admin-dashboard />
            @break

            @case('realtor')
                <x-realtor-dashboard />
            @break

            @default
                <x-user-dashboard />
            @endswitch
</x-app-layout>