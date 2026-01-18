<?php

namespace App\Livewire\Forms;

use App\Models\Article;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ArticleForm extends Form
{
    public ?Article $article;

    public $notification = 'none';
    public $published = true;

    #[Validate('required|min:2')]
    public $title;
    #[Validate('required|min:2')]
    public $content;


    public function setArticle(Article $article): void
    {
        $this->title = $article->title;
        $this->content = $article->content;
        $this->published = $article->published;
        $this->notification = $article->notification;
        $this->article = $article;
    }


    public function store(): void
    {
        $this->validate();
        Article::create($this->only(['title', 'content','published','notification']));
        cache()->forget('count-published-articles');

    }

    public function update(): void
    {
        $this->validate();
        $this->article->update($this->only(['title', 'content','published','notification']));
        cache()->forget('count-published-articles');

    }
}
