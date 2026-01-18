<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use function Symfony\Component\Translation\t;

#[Lazy]
class PublishedCount extends Component
{


    public $placeholderText = '';

    #[Computed(cache: true,key: 'count-published-articles')]
    public function count()
    {
         return Article::where('published', 1)->count();
    }

    public function placeholder()
    {
        return  view('livewire.placeholders.published-count',
            [
                'message' => $this->placeholderText,
            ]);
    }

    public function render()
    {
        return view('livewire.published-count');
    }
}
