<?php

declare(strict_types=1);

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

final class SettingsPage extends Component
{
    #[Layout('components.layouts.app')]
    #[Title('Organization Settings')]
    public function render(): View
    {
        return view('livewire.settings-page');
    }
}
