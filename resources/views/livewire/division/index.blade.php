<div>
    <flux:main container class="max-w-xl lg:max-w-3xl">

        <div class="flex justify-between">
            <flux:heading size="xl">Divisions</flux:heading>
            <livewire:division.create-modal />
        </div>

        <flux:separator variant="subtle" class="my-8" />

        <div class="max-w-md mx-auto">
            <flux:table>
                <flux:table.rows>
                    @forelse($divisions as $division)
                        <flux:table.row>
                            <flux:table.cell>{{ $division->name }}</flux:table.cell>
                            <flux:table.cell align="end">
                                <flux:dropdown>
                                    <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" inset="top bottom"></flux:button>
                                    <flux:menu>
                                        <flux:menu.item wire:click="delete({{ $division->id }})" wire:confirm="Are you sure you want to delete this division?" icon="trash" variant="danger">Delete</flux:menu.item>
                                    </flux:menu>
                                </flux:dropdown>
                            </flux:table.cell>
                        </flux:table.row>
                    @empty
                        <div class="flex justify-center">
                            <flux:text>No divisions added</flux:text>
                        </div>
                    @endforelse
                </flux:table.rows>
            </flux:table>
        </div>

    </flux:main>
</div>
