<div>
    <flux:modal.trigger name="add-division">
        <flux:button variant="primary" size="xs">Add Division</flux:button>
    </flux:modal.trigger>

    <flux:modal name="add-division" class="md:w-96">
        <form wire:submit.prevent="createDivision" class="space-y-6">
            <div>
                <flux:heading size="lg">Add Division</flux:heading>
            </div>

            <flux:input label="Name" wire:model="name" placeholder="11U" />

            <div class="flex">
                <flux:spacer />

                <div class="flex gap-2">
                    <flux:button type="submit" variant="primary">Create</flux:button>
                    <flux:modal.close>
                        <flux:button variant="ghost">Cancel</flux:button>
                    </flux:modal.close>
                </div>
            </div>
        </form>
    </flux:modal>
</div>
