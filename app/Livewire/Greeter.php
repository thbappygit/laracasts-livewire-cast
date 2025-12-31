<?php

namespace App\Livewire;

use Livewire\Component;

class Greeter extends Component
{

    public $name = 'John';
    public function render()
    {
        return view('livewire.greeter');
    }

    public function changeName($name): void
    {
        $this->name = $name;
    }
}
