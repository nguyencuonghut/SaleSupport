<?php

namespace App\Http\Livewire;

use App\Models\Policy;
use Livewire\Component;

class UserPolicyDetailComponent extends Component
{
    public $policy_id;

    public function mount($policy_id)
    {
        $policy = Policy::findOrFail($policy_id);
        $this->policy_id = $policy->id;
    }

    public function render()
    {
        $policy = Policy::findOrFail($this->policy_id);
        return view('livewire.user-policy-detail-component', ['policy' => $policy])->layout('layouts.base');
    }
}
