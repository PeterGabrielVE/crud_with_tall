<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Article;
use Livewire\WithPagination;
class Articles extends Component
{
    use WithPagination;

    public function render()
    {
        $articles = Article::where('user_id', auth()->user()->id)->paginate(10);
        return view('livewire.articles',[
            'articles' => $articles,
        ]);
    }
}
