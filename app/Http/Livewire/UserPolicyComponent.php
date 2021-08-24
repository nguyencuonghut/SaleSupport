<?php

namespace App\Http\Livewire;

use App\Models\Policy;
use Livewire\Component;

class UserPolicyComponent extends Component
{
    public $events = '';

    public function getevent()
    {
        $events = Policy::select('id','title','content', 'start', 'end')->get();

        return  json_encode($events);
    }

    /**
    * Write code on Method
    *
    * @return response()
    */
    public function render()
    {
        $events = Policy::select('id','title', 'content', 'start', 'end', 'backgroundColor', 'borderColor')->get();

        $this->events = json_encode($events);
        return view('livewire.user-policy-component')->layout('layouts.base');
    }
}
