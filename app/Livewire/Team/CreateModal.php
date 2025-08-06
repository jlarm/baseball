<?php

declare(strict_types=1);

namespace App\Livewire\Team;

use App\Enums\Division;
use App\Models\Season;
use Flux\Flux;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

final class CreateModal extends Component
{
    #[Validate(['required', 'string', 'unique:teams,uuid'])]
    public string $name = '';

    #[Validate(['required', 'string'])]
    public string $division = '';

    public function save(): void
    {
        $this->validate();

        $currentSeason = current_season();

        if ($currentSeason instanceof Season) {
            $currentSeason->teams()->create([
                'name' => $this->name,
                'division' => Division::from($this->division),
            ]);

            $this->dispatch('team-created');
        }

        $this->reset(['name', 'division']);

        $this->modal('add-team')->close();

        Flux::toast(
            text: 'The team has been created.',
            heading: 'Success',
            variant: 'success',
        );
    }

    public function render(): View
    {
        return view('livewire.team.create-modal');
    }
}
