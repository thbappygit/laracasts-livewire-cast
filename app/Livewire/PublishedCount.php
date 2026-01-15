<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use function Symfony\Component\Translation\t;

#[Lazy]
class PublishedCount extends Component
{
    public $count = 0;

    public $placeholderText = '';

    public function mount(): void
    {
        sleep(3);
        $this->count = Article::where('published', 1)->count();
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
