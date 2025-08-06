<?php

declare(strict_types=1);

namespace App\Livewire\Division;

use App\Models\Division;
use Illuminate\View\View;
use Livewire\Component;

final class Show extends Component
{
    public Division $division;

    public function render(): View
    {
        return view('livewire.division.show')
            ->title($this->division->name);
    }
}
