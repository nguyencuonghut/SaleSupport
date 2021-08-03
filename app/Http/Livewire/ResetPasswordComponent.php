<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ResetPasswordComponent extends Component
{
    public $user_id;
    public $password;
    public $password_confirmation;


    public function mount($user_id)
    {
        $this->user_id = $user_id;
    }


    public function resetPassword()
    {
        $rules = [
            'password'              => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
        ];
        $messages = [
            'password.required' => 'Bạn phải nhập mật khẩu.',
            'password.confirmed' => 'Mật khẩu không khớp.',
            'password.min' => 'Bạn phải nhập mật khẩu dài ít nhất 6 ký tự.',
            'password_confirmation.required' => 'Bạn phải xác nhận mật khẩu.',
        ];
        $this->validate($rules,$messages);

        $user = User::findOrFail($this->user_id);
        $user->password = Hash::make($this->password);
        $user->save();

        Session::flash('success_message', 'Cập nhật mật khẩu thành công!');
        return redirect()->route('admin.users');
    }

    public function render()
    {
        return view('livewire.reset-password-component')->layout('layouts.base');
    }
}
