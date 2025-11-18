<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- Custom Minimal CSS --}}
    <style>
        .admin-btn {
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            background-color: #111827; /* dark modern gray */
            color: #fff;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: .25s ease;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .admin-btn:hover {
            background-color: #1f2937; /* slightly lighter */
            transform: translateY(-1px);
        }

        .admin-btn:active {
            transform: translateY(0);
            background-color: #0f172a;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{ __("You're logged in!") }}

                    <!-- Admin Button -->
                    <div class="mt-6">
                        <a href="/admin" class="admin-btn">
                            Go to Admin Panel
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
