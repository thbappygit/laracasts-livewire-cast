<?php

namespace App\Livewire;

use App\Models\Greeting;
use Livewire\Attributes\Validate;
use Livewire\Component;
use function Symfony\Component\Translation\t;

class Greeter extends Component
{

    #[Validate('required|min:2')]
    public $name = '';
    public $greeting = '';
    public $greetings = [];

    public $greetingMessage = '';


    public function mount()
    {
        $this->greetings = Greeting::all();

    }

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


    //updated Hook

    public function updated($property, $value){
        if ($property === 'greeting'){
            $this->greeting = strtoupper($value);
        }
    }

//    another way to do it,mostly used
    public function updatedName($value){
        $this->name = strtoupper($value);
    }




}
