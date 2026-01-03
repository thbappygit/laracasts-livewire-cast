<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout( 'components.layouts.admin')]
class AdminComponent extends Component
{
    public function render()
    {
        return view('livewire.dashboard');
    }
}
