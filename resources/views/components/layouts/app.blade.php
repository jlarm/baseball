<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main class="bg-white rounded-xl border m-2">
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>
