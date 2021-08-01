<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserComponent extends Component
{
    use WithPagination;

    public $search;
    public $sortField;
    public $sortAsc;

    public function mount()
    {
        $this->search = '';
        $this->sortField = 'id';
        $this->sortAsc = false;
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function render()
    {
        $users = User::where('id', 'like', '%'.$this->search.'%')
                    ->orWhere('name', 'like', '%'.$this->search.'%')
                    ->orWhere('email', 'like', '%'.$this->search.'%')
                    ->orWhere('type', 'like', '%'.$this->search.'%')
                    ->orWhereHas('department', function($q)
                    {
                        $q->where('name', 'like', '%'.$this->search.'%');

                    })
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate(10);
        return view('livewire.user-component', ['users' => $users])->layout('layouts.base');
    }
}
