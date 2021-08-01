<?php

namespace App\Http\Livewire;

use App\Models\Department;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class AddDepartmentComponent extends Component
{

    public $code;
    public $name;
    public $description;

    public function addDepartment()
    {
        $rules = [
            'code'              => 'required|unique:departments|max:255',
            'name'              => 'required',
            'description'        => 'max:255',
        ];
        $messages = [
            'code.required' => 'Bạn phải nhập mã.',
            'code.unique' => 'Mã đã tồn tại. Bạn hãy chọn mã khác.',
            'code.max' => 'Mã dài quá 255 ký tự.',
            'name.required' => 'Bạn phải nhập tên.',
            'name.max' => 'Tên dài quá 255 ký tự.',
            'desciption.max' => 'Mô tả dài quá 255 ký tự.',
        ];
        $this->validate($rules,$messages);

        $department = new Department();
        $department->code = $this->code;
        $department->name = $this->name;
        $department->description = $this->description;
        $department->save();

        Session::flash('success_message', 'Phòng mới được tạo thành công!');
        return redirect()->route('admin.departments');
    }
    public function render()
    {
        return view('livewire.add-department-component')->layout('layouts.base');
    }
}
