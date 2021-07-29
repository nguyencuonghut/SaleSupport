<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserComponent extends Component
{
    use WithPagination;

    public function render()
    {
        $users = User::orderBy('id', 'desc')->paginate(20);
        return view('livewire.user-component', ['users' => $users])->layout('layouts.base');
    }
}
