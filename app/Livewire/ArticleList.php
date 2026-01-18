<?php

namespace App\Livewire;

use App\Models\Article;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Manage Articles')]
class ArticleList extends AdminComponent
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $showOnlyPublished = false;

    public string $search = '';

    #[Computed()]
    public function articles()
    {
        $query = Article::query();

        if ($this->showOnlyPublished) {
            $query->where('published', 1);
        }

        if (trim($this->search) !== '') {
            $s = '%' . str_replace('%', '\\%', $this->search) . '%';
            $query->where('title', 'like', $s);
        }

        return $query->paginate(10, pageName: 'article-page');

    }


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

    public function updatedSearch(): void
    {
        $this->resetPage(pageName: 'article-page');
    }

//    public function render(): Factory|View|\Illuminate\View\View
//    {
//        return view('livewire.article-list');
////        $query = Article::query();
////
////        if ($this->showOnlyPublished) {
////            $query->where('published', 1);
////        }
////
////        if (trim($this->search) !== '') {
////            $s = '%' . str_replace('%', '\\%', $this->search) . '%';
////            $query->where('title', 'like', $s);
////        }
////
////        return view('livewire.article-list', [
////            'articles' => $query->paginate(10, pageName: 'article-page')
////        ]);
//    }

    public function delete(Article $article): void
    {
        try {
            if ($this->articles()->count() < 10){
                throw new \Exception('Nope');
            }
            $article->delete();
            unset($this->articles);
            cache()->forget('count-published-articles');
            $this->dispatch('notify', type: 'success', message: 'Article deleted successfully.');
        } catch (\Throwable $e) {
            $this->dispatch('notify', type: 'error', message: 'Failed to delete article.');
        }
    }
}
