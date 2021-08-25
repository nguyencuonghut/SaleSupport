<?php

namespace App\Http\Livewire;

use App\Models\Policy;
use Carbon\Carbon;
use Livewire\Component;

class UserPolicyByMonthComponent extends Component
{
    public function render()
    {
        $policies = Policy::where('start', '<=', Carbon::now())
                        ->where('end', '>=', Carbon::now())
                        ->get();
        return view('livewire.user-policy-by-month-component', ['policies' => $policies])->layout('layouts.base');
    }
}
