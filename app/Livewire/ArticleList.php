<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title( 'Manage Articles')]
class ArticleList extends AdminComponent
{
    public function render()
    {
        return view('livewire.article-list',[
            'articles' => Article::all()
        ]);
    }

    public function delete(Article $article): void
    {
        $article->delete();
    }
}
