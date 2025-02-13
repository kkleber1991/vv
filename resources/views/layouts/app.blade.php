<x-base-layout>
    <div class="min-h-screen">
        @livewire('navigation-menu')

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</x-base-layout>
