<?php

declare(strict_types=1);

namespace App\Livewire\Season;

use App\Enums\Status;
use App\Models\Season;
use Flux\Flux;
use Illuminate\View\View;
use Livewire\Component;

final class CreateSeasonModal extends Component
{
    public string $year = '';

    public function createNewSeason(): void
    {
        $validated = $this->validate([
            'year' => 'required|string|regex:/^\d{4}-\d{4}$/',
        ], [
            'year.regex' => 'The year must be in a 2020-2021 format.',
        ]);

        Season::create([
            'year' => $validated['year'],
            'status' => Status::ACTIVE,
        ]);

        $this->reset('year');

        $this->dispatch('checklist-updated');

        $this->modal('create-new-season')->close();

        Flux::toast(
            text: 'The season was created.',
            heading: 'Success',
            variant: 'success',
        );
    }

    public function render(): View
    {
        return view('livewire.season.create-season-modal');
    }
}
