<?php

namespace App\Http\Livewire;

use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class EditUserComponent extends Component
{

    public $name;
    public $email;
    public $user_id;
    public $department_id;
    public $type;

    public function mount($user_id)
    {
        $this->user_id = $user_id;
        $user = User::findOrFail($user_id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->type = $user->type;
        $this->department_id = $user->department_id;
    }

    public function editUser()
    {
        $rules = [
            'name'                  => 'required',
            'email'                 => 'required|email|max:255',
            'department_id'         => 'required',
            'type'                  => 'required',
        ];
        $messages = [
            'name.required' => 'Bạn phải nhập tên.',
            'name.max' => 'Tên dài quá 255 ký tự.',
            'email.required' => 'Bạn phải nhập email.',
            'email.email' => 'Email của bạn không đúng định dạng.',
            'email.unique' => 'Email đã tồn tại. Bạn hãy chọn email khác.',
            'email.max' => 'Email dài quá 255 ký tự.',
            'department_id.required' => 'Bạn phải chọn phòng/ban.',
            'type.required' => 'Bạn phải chọn quyền.'
        ];
        $this->validate($rules,$messages);

        $user = User::findOrFail($this->user_id);
        $user->name = $this->name;
        $user->email = $this->email;
        $user->department_id = $this->department_id;
        $user->type = $this->type;
        $user->save();

        Session::flash('success_message', 'Nhân viên mới được cập nhật thành công!');
        return redirect()->route('admin.users');
    }

    public function render()
    {
        $departments = Department::orderBy('id', 'desc')->get();
        return view('livewire.edit-user-component', ['departments' => $departments])->layout('layouts.base');
    }
}
