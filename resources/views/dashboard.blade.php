<x-app-layout>
    

    @switch(Auth::user()->role)
    
    @case('admin')
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Admin Dashboard') }}
                </h2>
            </x-slot>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <x-admin-dashboard />
            </div>
            @break

            @case('realtor')
                <x-realtor-dashboard />
            @break

            @default
                <x-user-dashboard />
            @endswitch
</x-app-layout>