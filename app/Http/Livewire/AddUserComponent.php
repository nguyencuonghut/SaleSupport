<?php

namespace App\Http\Livewire;

use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class AddUserComponent extends Component
{
    public $name;
    public $email;
    public $department_id;
    public $password;
    public $password_confirmation;
    public $type;

    public function addUser()
    {
        $rules = [
            'name'                  => 'required',
            'email'                 => 'required|email|unique:users|max:255',
            'department_id'         => 'required',
            'password'              => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
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
            'password.required' => 'Bạn phải nhập mật khẩu.',
            'password.confirmed' => 'Mật khẩu không khớp.',
            'password.min' => 'Bạn phải nhập mật khẩu dài ít nhất 6 ký tự.',
            'password_confirmation.required' => 'Bạn phải xác nhận mật khẩu.',
            'type.required' => 'Bạn phải chọn quyền.'
        ];
        $this->validate($rules,$messages);

        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = Hash::make($this->password);
        $user->department_id = $this->department_id;
        $user->type = $this->type;
        $user->save();

        Session::flash('success_message', 'Nhân viên mới được tạo thành công!');
        return redirect()->route('admin.users');
    }

    public function render()
    {
        $departments = Department::orderBy('id', 'desc')->get();
        return view('livewire.add-user-component', ['departments' => $departments])->layout('layouts.base');
    }
}
