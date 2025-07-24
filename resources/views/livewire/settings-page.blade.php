<div class="max-w-2xl mx-auto">
    <flux:heading size="xl" class="mb-5">Organization Settings</flux:heading>
    <form class="space-y-5">
        <flux:field>
            <flux:label>Name</flux:label>

            <flux:input wire:model="name" type="text" />

            <flux:error name="name" />
        </flux:field>

        <flux:field>
            <flux:label>Address</flux:label>

            <flux:input wire:model="address" type="text" />

            <flux:error name="address" />
        </flux:field>

        <div class="grid grid-cols-3 gap-3">
            <flux:field>
                <flux:label>City</flux:label>

                <flux:input wire:model="city" type="text" />

                <flux:error name="city" />
            </flux:field>

            <flux:field>
                <flux:label>Address</flux:label>

                <flux:input wire:model="address" type="text" />

                <flux:error name="address" />
            </flux:field>

            <flux:field>
                <flux:label>Zip Code</flux:label>

                <flux:input wire:model="zipCode" type="text" />

                <flux:error name="zipCode" />
            </flux:field>
        </div>

        <flux:field>
            <flux:label>Logo</flux:label>

            <flux:input wire:model="logo" type="file" />

            <flux:error name="logo" />
        </flux:field>

        <flux:button variant="primary">Submit</flux:button>
    </form>
</div>
