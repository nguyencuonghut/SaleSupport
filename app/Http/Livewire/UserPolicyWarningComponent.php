<?php

namespace App\Http\Livewire;

use App\Models\Policy;
use Carbon\Carbon;
use Livewire\Component;

class UserPolicyWarningComponent extends Component
{
    public function render()
    {
        $policies = Policy::where('end', '>=', Carbon::now())
                    ->where('end', '<=', Carbon::now()->addDays(7))->get();
        return view('livewire.user-policy-warning-component', ['policies' => $policies])->layout('layouts.base');
    }
}
