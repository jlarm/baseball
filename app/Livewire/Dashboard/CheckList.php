<?php

declare(strict_types=1);

namespace App\Livewire\Dashboard;

use App\Models\Organization;
use Illuminate\View\View;
use Livewire\Component;

final class CheckList extends Component
{
    public int $totalSteps = 0;

    public int $completedSteps = 0;

    public float $percentComplete = 0;

    public array $steps = [];

    public function mount(): void
    {
        $this->steps = $this->buildSteps();
        $this->totalSteps = count($this->steps);
        $this->completedSteps = count(array_filter($this->steps, static fn ($step): bool => $step['completed'] === true));
        $this->percentComplete = $this->totalSteps === 0 ? 0 : round($this->completedSteps / $this->totalSteps * 100);
    }

    public function render(): View
    {
        return view('livewire.dashboard.check-list');
    }

    private function buildSteps(): array
    {
        return [
            [
                'title' => 'Organization Details',
                'description' => 'Add details about the organization',
                'routeName' => 'org.settings',
                'completed' => Organization::exists(),
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
