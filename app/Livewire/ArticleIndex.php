<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title( 'Articles')]
class ArticleIndex extends Component
{

//    public $articles;
//    public function mount(): void
//    {
//        $this->articles = Article::all();
//    }
    public function render()
    {
        return view('livewire.article-index',[
            'articles' => Article::all()
        ]);
    }
}
