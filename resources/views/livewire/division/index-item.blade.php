<flux:table.row>
    <flux:table.cell>{{ $division->name }}</flux:table.cell>
    <flux:table.cell align="end">
        <div class="flex justify-end items-center gap-2">
            <flux:button wire:navigate href="{{ route('divisions.show', $division) }}" size="xs" variant="filled">View</flux:button>
            <flux:button wire:click="delete({{ $division->id }})" wire:confirm="Are you sure you want to delete this division?" size="xs" variant="danger">Delete</flux:button>
        </div>
    </flux:table.cell>
</flux:table.row>
