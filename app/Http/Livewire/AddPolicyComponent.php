<?php

namespace App\Http\Livewire;

use App\Models\Policy;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class AddPolicyComponent extends Component
{
    public $name;
    public $content;
    public $date_range;


    public function addPolicy()
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

        $policy = new Policy();
        $policy->name = $this->name;
        $policy->content = $this->content;
        $policy->date_range = $this->date_range;
        $policy->save();

        Session::flash('success_message', 'Chính sách mới được tạo thành công!');
        return redirect()->route('admin.policies');
    }

    public function render()
    {
        return view('livewire.add-policy-component')->layout('layouts.base');
    }
}
