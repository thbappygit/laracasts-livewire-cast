<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Manage Articles')]
class ArticleList extends AdminComponent
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $showOnlyPublished = false;


    public function showAll(): void
    {
        $this->showOnlyPublished = false;
        $this->resetPage(pageName: 'article-page');
    }

    public function showPublished(): void
    {
        $this->showOnlyPublished = true;
        $this->resetPage(pageName: 'article-page');

    }

    public function render()
    {
        $query = Article::query();
        if ($this->showOnlyPublished) {
            $query->where('published', 1);
        }
        return view('livewire.article-list', [
            'articles' => $query->paginate(10, pageName: 'article-page')
        ]);
    }

    public function delete(int $id): void
    {
        try {
            $article = Article::findOrFail($id);
            $article->delete();
            $this->dispatch('notify', type: 'success', message: 'Article deleted successfully.');
        } catch (\Throwable $e) {
            $this->dispatch('notify', type: 'error', message: 'Failed to delete article.');
        }
    }
}
