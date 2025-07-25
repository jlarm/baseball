<div class="max-w-2xl mx-auto">
    <flux:heading size="xl" class="mb-5">Organization Settings</flux:heading>
    <form wire:submit.prevent="createOrUpdate" class="space-y-5">
        <flux:field>
            <flux:label>Name</flux:label>

            <flux:input wire:model="form.name" type="text" />

            <flux:error name="form.name" />
        </flux:field>

        <flux:field>
            <flux:label>Address</flux:label>

            <flux:input wire:model="form.address" type="text" />

            <flux:error name="form.address" />
        </flux:field>

        <div class="grid grid-cols-3 gap-3">
            <flux:field>
                <flux:label>City</flux:label>

                <flux:input wire:model="form.city" type="text" />

                <flux:error name="form.city" />
            </flux:field>

            <flux:field>
                <flux:label>State</flux:label>

                <flux:select variant="listbox" wire:model="form.state" searchable placeholder="Choose state...">
                    @foreach(\App\Enums\State::cases() as $state)
                        <flux:select.option>{{ $state }}</flux:select.option>
                    @endforeach
                </flux:select>

                <flux:error name="form.state" />
            </flux:field>

            <flux:field>
                <flux:label>Zip Code</flux:label>

                <flux:input wire:model="form.zipCode" type="text" />

                <flux:error name="form.zipCode" />
            </flux:field>
        </div>

        <flux:field>
            <flux:label>Logo</flux:label>
            
            <div class="space-y-4">
                <!-- File Input -->
                <flux:input 
                    wire:model="form.logo" 
                    type="file" 
                    accept="image/*"
                    class="block w-full"
                />

                <!-- Upload Progress -->
                <div wire:loading wire:target="form.logo" class="flex items-center space-x-2">
                    <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-indigo-500"></div>
                    <span class="text-sm text-gray-600">Uploading...</span>
                </div>

                <!-- Temporary Image Preview -->
                @if($temporaryImageUrl)
                    <div class="relative">
                        <img 
                            src="{{ $temporaryImageUrl }}" 
                            alt="Logo preview" 
                            class="h-24 w-24 object-cover rounded-lg border-2 border-dashed border-gray-300"
                        >
                        <button 
                            type="button" 
                            wire:click="removeLogo"
                            class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600 transition-colors"
                        >
                            ×
                        </button>
                        <div class="mt-2 text-sm text-gray-500">
                            Preview - save to confirm
                        </div>
                    </div>
                @elseif($organization && $organization->logo_path && !$form->logo)
                    <!-- Existing Saved Logo -->
                    <div class="relative">
                        <img 
                            src="{{ asset('storage/' . $organization->logo_path) }}" 
                            alt="Current logo" 
                            class="h-24 w-24 object-cover rounded-lg border"
                        >
                        <button 
                            type="button" 
                            wire:click="removeLogo"
                            class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600 transition-colors"
                        >
                            ×
                        </button>
                        <div class="mt-2 text-sm text-gray-600">
                            Current logo
                        </div>
                    </div>
                @endif
            </div>

            <flux:error name="form.logo" />
        </flux:field>

        <flux:button type="submit" variant="primary">Submit</flux:button>
    </form>
</div>
