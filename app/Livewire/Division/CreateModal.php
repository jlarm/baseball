<?php

declare(strict_types=1);

namespace App\Livewire\Division;

use Flux\Flux;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

final class CreateModal extends Component
{
    #[Validate('required', 'string', 'min:2', 'max:255')]
    public string $name = '';

    public function createDivision(): void
    {
        $this->validate();

        $currentSeason = current_season();

        if ($currentSeason instanceof \App\Models\Season) {
            $currentSeason->divisions()->create([
                'name' => $this->name,
            ]);
        }

        $this->reset('name');

        $this->dispatch('division-created');

        Flux::toast(
            text: 'The division has been created.',
            heading: 'Success',
            variant: 'success',
        );
    }

    public function cancel(): void
    {
        $this->reset('name');

    }

    public function render(): View
    {
        return view('livewire.division.create-modal');
    }
}
