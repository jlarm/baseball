<div>
    <flux:modal.trigger name="create-new-season">
        <flux:button variant="primary" class="w-full">Start</flux:button>
    </flux:modal.trigger>

    <flux:modal name="create-new-season" class="md:w-96">
        <form wire:submit.prevent="createNewSeason">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Start a New Season</flux:heading>
                </div>

                <flux:field>
                    <flux:label>Year</flux:label>

                    <flux:input wire:model="year" type="text" placeholder="2025-2026" />

                    <flux:error name="year" />
                </flux:field>

                <div class="flex">
                    <flux:spacer />

                    <flux:button type="submit" variant="primary">Create</flux:button>
                </div>
            </div>
        </form>
    </flux:modal>

</div>
