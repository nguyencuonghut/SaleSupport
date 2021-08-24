<?php

namespace App\Http\Livewire;

use App\Models\Policy;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class EditPolicyComponent extends Component
{
    public $policy_id;
    public $title;
    public $content;
    public $date_range;

    public function mount($policy_id)
    {
        $this->policy_id = $policy_id;
        $policy = Policy::findOrFail($policy_id);
        $this->title = $policy->title;
        $this->content = $policy->content;
        $this->date_range = Carbon::parse($policy->start)->format('m/d/Y') . ' - ' . Carbon::parse($policy->end)->format('m/d/Y') ;
    }

    public function editPolicy()
    {
        $rules = [
            'title'             => 'required',
            'content'           => 'required',
            'date_range'        => 'required',
        ];
        $messages = [
            'title.required' => 'Bạn phải nhập tiêu đề chính sách.',
            'content.required' => 'Bạn phải nhập nội dung chính sách.',
            'date_range.required' => 'Bạn phải nhập thời gian áp dụng.',
        ];
        $this->validate($rules,$messages);

        $policy = Policy::findOrFail($this->policy_id);
        $policy->title = $this->title;
        $policy->content = $this->content;
        //Parse date range
        $dates = explode(' - ', $this->date_range);
        $policy->start = Carbon::parse($dates[0]);
        $policy->end = Carbon::parse($dates[1]);
        $policy->save();

        Session::flash('success_message', 'Chính sách được sửa thành công!');
        return redirect()->route('admin.policies');
    }

    public function render()
    {
        return view('livewire.edit-policy-component')->layout('layouts.base');
    }
}
