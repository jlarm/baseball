<?php

declare(strict_types=1);

namespace App\Livewire\Dashboard;

use App\Models\Organization;
use App\Services\OrganizationService;
use Illuminate\View\View;
use Livewire\Component;

final class CheckList extends Component
{
    public ?Organization $organization = null;

    public int $totalSteps = 0;

    public int $completedSteps = 0;

    public float $percentComplete = 0;

    /** @var array<int, array{title: string, description: string, routeName: string, completed: bool}> */
    public array $steps = [];

    public function mount(OrganizationService $organizationService): void
    {
        $this->organization = $organizationService->current();
        $this->steps = $this->buildSteps($organizationService);
        $this->totalSteps = count($this->steps);
        $this->completedSteps = count(array_filter($this->steps, static fn (array $step): bool => $step['completed']));
        $this->percentComplete = $this->totalSteps === 0 ? 0 : round($this->completedSteps / $this->totalSteps * 100);
    }

    public function skipSetup(): void
    {
        $this->organization?->update([
            'checklist_completed' => true,
        ]);
    }

    public function render(): View
    {
        return view('livewire.dashboard.check-list');
    }

    /** @return array<int, array{title: string, description: string, routeName: string, completed: bool}> */
    private function buildSteps(OrganizationService $organizationService): array
    {
        return [
            [
                'title' => 'Organization Details',
                'description' => 'Add details about the organization',
                'routeName' => 'org.settings',
                'completed' => $organizationService->current() !== null,
            ],
            [
                'title' => 'Divisions',
                'description' => 'Add divisions to the organization',
                'routeName' => 'org.settings',
                'completed' => false,
            ],
            [
                'title' => 'Teams',
                'description' => 'Add teams to the divisions',
                'routeName' => 'org.settings',
                'completed' => false,
            ],
            [
                'title' => 'Players',
                'description' => 'Add players to the teams',
                'routeName' => 'org.settings',
                'completed' => false,
            ],
        ];
    }
}
