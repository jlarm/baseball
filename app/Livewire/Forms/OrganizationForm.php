<?php

declare(strict_types=1);

namespace App\Livewire\Forms;

use App\Enums\State;
use App\Models\Organization;
use Illuminate\Http\UploadedFile;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\WithFileUploads;

final class OrganizationForm extends Form
{
    use WithFileUploads;

    #[Validate('required|string|min:3|max:255')]
    public string $name = '';

    #[Validate('nullable|string|min:3|max:255')]
    public string $address = '';

    #[Validate('nullable|string|min:3|max:255')]
    public string $city = '';

    #[Validate('nullable|string')]
    public string $state = '';

    #[Validate('nullable|string|min:3|max:255')]
    public string $zipCode = '';

    #[Validate('nullable|image|max:2048')]
    public ?UploadedFile $logo = null;

    #[Validate('nullable|string|min:3|max:255')]
    public string $logoPath = '';

    public function create(): Organization
    {
        $this->validate();

        $logoPath = $this->storeLogo();

        return Organization::create([
            'name' => $this->name,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state !== '' && $this->state !== '0' ? State::from($this->state) : null,
            'zip_code' => $this->zipCode,
            'logo_path' => $logoPath ?? $this->logoPath,
        ]);
    }

    public function update(Organization $organization): Organization
    {
        $this->validate();

        $logoPath = $this->storeLogo();

        $organization->update([
            'name' => $this->name,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state !== '' && $this->state !== '0' ? State::from($this->state) : null,
            'zip_code' => $this->zipCode,
            'logo_path' => $logoPath ?? $this->logoPath,
        ]);

        return $organization->fresh();
    }

    public function fillFromOrganization(Organization $organization): void
    {
        $this->name = $organization->name ?? '';
        $this->address = $organization->address ?? '';
        $this->city = $organization->city ?? '';
        $this->state = $organization->state->value ?? '';
        $this->zipCode = $organization->zip_code ?? '';
        $this->logoPath = $organization->logo_path ?? '';
    }

    private function storeLogo(): ?string
    {
        if (! $this->logo instanceof UploadedFile) {
            return null;
        }

        return $this->logo->store('logos', 'public');
    }
}
