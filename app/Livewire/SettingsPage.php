<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Organization;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

final class SettingsPage extends Component
{
    public Organization $organization;
    public string $name = '';
    public string $address = '';
    public string $city = '';

    public function mount(): void
    {
        $this->organization = Organization::first();
        $this->name = $this->organization->name;
        $this->address = $this->organization->address;
        $this->city = $this->organization->city;
    }

    #[Layout('components.layouts.app')]
    #[Title('Organization Settings')]
    public function render(): View
    {
        return view('livewire.settings-page');
    }
}
