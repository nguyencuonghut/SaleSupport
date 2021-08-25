<?php

namespace App\Http\Livewire;

use App\Models\Policy;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class AddPolicyComponent extends Component
{
    public $title;
    public $content;
    public $date_range;

    function get_random_color(){
        $chars = '456789ABCDEF';
        $color = '#';
        for ( $i = 0; $i < 6; $i++ ) {
           $color .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $color;
    }

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

        $policy = new Policy();
        $policy->title = $this->title;
        $policy->content = $this->content;
        //Parse date range
        $dates = explode(' - ', $this->date_range);
        $policy->start = Carbon::parse($dates[0]);
        $policy->end = Carbon::parse($dates[1]);
        $policy->backgroundColor = $this->get_random_color();
        $policy->borderColor = $policy->backgroundColor;
        $policy->url = "null";
        $policy->save();

        //Update the url
        $policy->url = 'policy/show/' . $policy->id;
        $policy->save();

        Session::flash('success_message', 'Chính sách mới được tạo thành công!');
        return redirect()->route('admin.policies');
    }

    public function render()
    {
        return view('livewire.add-policy-component')->layout('layouts.base');
    }
}
