<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout( 'components.layouts.admin')]
class AdminComponent extends Component
{
    use WithFileUploads;
//    public function render()
//    {
//        return view('livewire.dashboard');
//    }
}
