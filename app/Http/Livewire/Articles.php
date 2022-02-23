<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Article;
use Livewire\WithPagination;
class Articles extends Component
{
    use WithPagination;

    public $active;
    public $q;

    public function render()
    {
        $articles = Article::where('user_id', auth()->user()->id)
        ->when( $this->q, function($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%'.$this->q . '%')
                    ->orWhere('price', 'like', '%' .$this->q . '%')
                    ->orWhere('quantity', 'like', '%' .$this->q . '%');
            });
        })
        ->when($this->active, function($query){
            return $query->active();
        });
        $query = $articles->toSql();
        $articles  = $articles->paginate(10);

        return view('livewire.articles',[
            'articles' => $articles,
            'query' => $query,
        ]);
    }

    public function updatingActive(){
        $this->resetPage();
    }

    public function updatingQ()
    {
        $this->resetPage();
    }
}
