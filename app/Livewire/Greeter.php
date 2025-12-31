<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;
use function Symfony\Component\Translation\t;

class Greeter extends Component
{

    #[Validate('required|min:2')]
    public $name = '';
    public $greeting = '';

    public $greetingMessage = '';

//    public function rules()
//    {
//        return [
//            'name' => 'required|min:2',
//        ];
//    }


    public function render()
    {
        return view('livewire.greeter');
    }

    public function changeGreeting()
    {
        $this->reset('greetingMessage');
        $this->validate();
        $this->greetingMessage = "{$this->greeting}, {$this->name}";
    }
}
