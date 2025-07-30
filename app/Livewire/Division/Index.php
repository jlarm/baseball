<?php

declare(strict_types=1);

namespace App\Livewire\Division;

use App\Models\Division;
use Flux\Flux;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

final class Index extends Component
{
    public function delete($id): void
    {
        $division = Division::find($id);

        if ($division) {
            $division->delete();
        }

        $this->dispatch('division.deleted');

        Flux::toast(
            text: 'The division has deleted.',
            heading: 'Success',
            variant: 'success',
        );
    }

    #[Title('Divisions')]
    #[On('division-created')]
    #[On('division-deleted')]
    public function render(): View
    {
        $currentSeason = current_season();
        $divisions = $currentSeason ? $currentSeason->divisions()->orderBy('name')->get() : collect();

        return view('livewire.division.index', [
            'divisions' => $divisions,
        ]);
    }
}
