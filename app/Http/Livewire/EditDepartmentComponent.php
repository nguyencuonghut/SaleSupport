<?php

namespace App\Http\Livewire;

use App\Models\Department;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class EditDepartmentComponent extends Component
{
    public $department_id;
    public $code;
    public $name;
    public $description;

    public function mount($department_id)
    {
        $this->department_id = $department_id;
        $department = Department::findOrFail($department_id);
        $this->code = $department->code;
        $this->name = $department->name;
        $this->description = $department->description;
    }

    public function editDepartment()
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

        $department = Department::findOrFail($this->department_id);
        $department->code = $this->code;
        $department->name = $this->name;
        $department->description = $this->description;
        $department->save();

        Session::flash('success_message', 'Phòng ban được sửa thành công!');
        return redirect()->route('admin.departments');
    }

    public function render()
    {
        return view('livewire.edit-department-component')->layout('layouts.base');
    }
}
