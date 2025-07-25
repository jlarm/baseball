<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Livewire\Forms\OrganizationForm;
use App\Models\Organization;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

final class SettingsPage extends Component
{
    use WithFileUploads;

    public ?Organization $organization = null;

    public OrganizationForm $form;

    public bool $uploading = false;

    public ?string $temporaryImageUrl = null;

    public function mount(): void
    {
        $this->organization = Organization::first();

        if ($this->organization instanceof Organization) {
            $this->form->fillFromOrganization($this->organization);
        }
    }

    public function createOrUpdate(): void
    {
        $this->organization = $this->organization instanceof Organization ? $this->form->update($this->organization) : $this->form->create();

        $this->temporaryImageUrl = null;

        session()->flash('status', 'Organization settings saved successfully.');
    }

    public function updatedFormLogo(): void
    {
        $this->uploading = false;
        $this->validate(['form.logo' => 'nullable|image|max:2048']);

        if ($this->form->logo && method_exists($this->form->logo, 'temporaryUrl')) {
            $this->temporaryImageUrl = $this->form->logo->temporaryUrl();
        }
    }

    public function updatingFormLogo(): void
    {
        $this->uploading = true;
        $this->temporaryImageUrl = null;
    }

    public function removeLogo(): void
    {
        $this->form->logo = null;
        $this->temporaryImageUrl = null;

        if ($this->organization instanceof Organization && $this->organization->logo_path) {
            $this->form->logoPath = '';
        }
    }

    #[Layout('components.layouts.app')]
    #[Title('Organization Settings')]
    public function render(): View
    {
        return view('livewire.settings-page');
    }
}
