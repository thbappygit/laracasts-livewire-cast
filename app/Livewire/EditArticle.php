<?php

namespace App\Livewire;

use App\Livewire\Forms\ArticleForm;
use App\Models\Article;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditArticle extends AdminComponent
{

     public ArticleForm $articleForm;

    public function mount(Article $article)
    {
        $this->articleForm->setArticle($article);
    }


    public function save()
    {
        $this->articleForm->update();
        session()->flash('success', 'Article updated successfully.');
        $this->redirect(route('dashboard.articles'), navigate: true);
    }

    public function render()
    {
        return view('livewire.edit-article');
    }

}
