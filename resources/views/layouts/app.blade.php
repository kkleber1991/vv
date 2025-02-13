<x-base-layout>
    <div class="min-h-screen">
        @livewire('navigation-menu')

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</x-base-layout>
