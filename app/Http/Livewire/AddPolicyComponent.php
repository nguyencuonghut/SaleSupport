<?php

namespace App\Http\Livewire;

use App\Models\Policy;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class AddPolicyComponent extends Component
{
    public $title;
    public $content;
    public $date_range;


    public function addPolicy()
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

        $colors = ['#f56954', '#f39c12', '#0073b7', '#00c0ef', '#00a65a', '#3c8dbc'];
        $policy = new Policy();
        $policy->title = $this->title;
        $policy->content = $this->content;
        //Parse date range
        $dates = explode(' - ', $this->date_range);
        $policy->start = Carbon::parse($dates[0]);
        $policy->end = Carbon::parse($dates[1]);
        $policy->backgroundColor = Arr::random($colors);
        $policy->borderColor = $policy->backgroundColor;
        $policy->save();

        Session::flash('success_message', 'Chính sách mới được tạo thành công!');
        return redirect()->route('admin.policies');
    }

    public function render()
    {
        return view('livewire.add-policy-component')->layout('layouts.base');
    }
}
