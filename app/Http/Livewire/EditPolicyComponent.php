<?php

namespace App\Http\Livewire;

use App\Models\Policy;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class EditPolicyComponent extends Component
{
    public $policy_id;
    public $name;
    public $content;
    public $date_range;

    public function mount($policy_id)
    {
        $this->policy_id = $policy_id;
        $policy = Policy::findOrFail($policy_id);
        $this->name = $policy->name;
        $this->content = $policy->content;
        $this->date_range = $policy->date_range;
    }

    public function editPolicy()
    {
        $rules = [
            'name'              => 'required',
            'content'           => 'required',
            'date_range'        => 'required',
        ];
        $messages = [
            'name.required' => 'Bạn phải nhập tên chính sách.',
            'content.required' => 'Bạn phải nhập nội dung chính sách.',
            'date_range.required' => 'Bạn phải nhập thời gian áp dụng.',
        ];
        $this->validate($rules,$messages);

        $policy = Policy::findOrFail($this->policy_id);
        $policy->name = $this->name;
        $policy->content = $this->content;
        $policy->date_range = $this->date_range;
        $policy->save();

        Session::flash('success_message', 'Chính sách được sửa thành công!');
        return redirect()->route('admin.policies');
    }

    public function render()
    {
        return view('livewire.edit-policy-component')->layout('layouts.base');
    }
}
