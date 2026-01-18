<?php

namespace App\Livewire\Forms;

use App\Models\Article;
use Illuminate\Support\Facades\Storage;
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

    #[Validate('nullable|image|max:5120')]
    public $image; // Livewire TemporaryUploadedFile

    public function setArticle(Article $article): void
    {
        $this->title = $article->title;
        $this->content = $article->content;
        $this->published = $article->published;
        $this->notification = $article->notification;
        $this->article = $article;
        $this->image = null; // reset image input
    }

    public function store(): void
    {
        $this->validate();

        $data = $this->only(['title', 'content','published','notification']);

        if ($this->image) {
            $data['image_path'] = $this->image->store('articles', 'public');
        }

        Article::create($data);

        // clear cache and reset file input
        cache()->forget('count-published-articles');
        $this->image = null;
    }

    public function update(): void
    {
        $this->validate();

        $data = $this->only(['title', 'content','published','notification']);

        if ($this->image) {
            // delete old image if present
            if ($this->article && $this->article->image_path && Storage::disk('public')->exists($this->article->image_path)) {
                Storage::disk('public')->delete($this->article->image_path);
            }
            $data['image_path'] = $this->image->store('articles', 'public');
        }

        $this->article->update($data);
        cache()->forget('count-published-articles');
        $this->image = null;
    }
}
