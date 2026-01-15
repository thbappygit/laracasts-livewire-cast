<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Search extends Component
{
//    #[Validate('required|min:2')]
    #[Url(as:'q', except: '')]
    public $searchText = '';
//    public $searchResults = [];

    public $placeholder;

    public  string $showHello = '';


    public function render()
    {
        return view('livewire.search',[
            'searchResults' => Article::where('title', 'like', "%{$this->searchText}%")->get()
        ]);
    }

//    public function updatedSearchText($value): void
//    {
//        $this->reset('searchResults');
//        $this->validate();
//        $searchTerm = "%{$value}%";
//        $this->searchResults = Article::where('title', 'like', $searchTerm)->get();
//
//    }


    #[On('cross:close-search')]
    public function clear(): void
    {
        $this->reset('searchText');
    }


    #[On('hello-from:search-result')]
    public function showHelloText(): void
    {
        $this->showHello = "Hello Vaiya";

    }
}
