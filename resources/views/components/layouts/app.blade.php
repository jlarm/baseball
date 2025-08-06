<x-layouts.app.header :title="$title ?? null">
    <flux:main class="bg-white m-2">
        {{ $slot }}
    </flux:main>
</x-layouts.app.header>
