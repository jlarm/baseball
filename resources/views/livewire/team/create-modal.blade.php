<div>
    <flux:modal.trigger name="add-team">
        <flux:button size="sm" variant="primary" class="mr-3">Add Team</flux:button>
    </flux:modal.trigger>

    <flux:modal name="add-team" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Add New Team</flux:heading>
            </div>
            <form wire:submit.prevent="save" class="space-y-6">
                <flux:input wire:model="name" label="Name" placeholder="Eagles 13U Smith" />
                <flux:select wire:model="division" placeholder="Choose division...">
                    <flux:select.option value="">Choose division...</flux:select.option>
                    @foreach(\App\Enums\Division::cases() as $division)
                        <flux:select.option value="{{ $division->value }}">{{ $division->value }}</flux:select.option>
                    @endforeach
                </flux:select>
                <div class="flex">
                    <flux:spacer />
                    <flux:button type="submit" variant="primary">Create</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>
</div>
