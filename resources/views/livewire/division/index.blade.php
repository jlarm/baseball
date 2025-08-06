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
                        <livewire:division.index-item :$division />
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
