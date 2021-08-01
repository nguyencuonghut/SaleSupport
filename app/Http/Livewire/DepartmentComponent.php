<?php

namespace App\Http\Livewire;

use App\Models\Department;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class DepartmentComponent extends Component
{
    public $search;
    public $sortField;
    public $sortAsc;

    public function mount()
    {
        $this->search = '';
        $this->sortField = 'id';
        $this->sortAsc = false;
    }


    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }


    public function deleteDepartment($id)
    {
        $department = Department::findOrFail($id);
        if(!$department->users->count()) {
            //Delete this department
            $department->delete();
            Session::flash('success_message', 'Xóa phòng ban thành công!');
            return redirect()->route('admin.departments');
        } else {
            Session::flash('error_message', 'Đang tồn tại nhân viên trong phòng ban này. Không thể xóa!');
            return redirect()->route('admin.departments');
        }

    }

    public function render()
    {
        $departments = Department::where('id', 'like', '%'.$this->search.'%')
                                ->orWhere('code', 'like', '%'.$this->search.'%')
                                ->orWhere('name', 'like', '%'.$this->search.'%')
                                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                                ->get();
        return view('livewire.department-component', ['departments' => $departments])->layout('layouts.base');
    }
}
