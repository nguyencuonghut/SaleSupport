<?php

namespace App\Http\Livewire;

use App\Models\Policy;
use Livewire\Component;

class UserAllPolicyComponent extends Component
{
    public function render()
    {
        $policies = Policy::all();
        return view('livewire.user-all-policy-component', ['policies' => $policies])->layout('layouts.base');
    }
}
