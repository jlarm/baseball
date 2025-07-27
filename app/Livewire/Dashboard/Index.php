<?php

declare(strict_types=1);

namespace App\Livewire\Dashboard;

use App\Models\Organization;
use App\Services\OrganizationService;
use Illuminate\View\View;
use Livewire\Component;

final class Index extends Component
{
    public ?Organization $organization = null;

    public function mount(OrganizationService $organizationService): void
    {
        $this->organization = $organizationService->current();
    }

    public function checklistCompleted(): bool
    {
        return $this->organization->checklist_completed ?? false;
    }

    public function render(): View
    {
        return view('livewire.dashboard.index');
    }
}
