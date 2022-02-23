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
    public $sortBy = 'id';
    public $sortAsc = true;

    protected $queryString = [
        'active' => ['except' => false],
        'q' => ['except' => ''],
        'sortBy' => ['except' => 'id'],
        'sortAsc' => ['except' => true],
    ];

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
        })
        ->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC');
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

    public function sortBy ($field)
    {
        if($field == $this->sortBy) {
            $this->sortAsc = !$this->sortAsc;
        }
        $this->sortBy = $field;
    }
}
