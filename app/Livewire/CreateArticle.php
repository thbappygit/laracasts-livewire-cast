<?php

namespace App\Livewire;

use App\Livewire\Forms\ArticleForm;
use App\Models\Article;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title( 'Create Article')]
class CreateArticle extends AdminComponent
{

    public ArticleForm $form;

    public function save(): void
    {
        $this->form->store();
        $this->redirect(route('dashboard.articles'), navigate: true);
    }

    public function render()
    {
        return view('livewire.create-article');
    }
}
