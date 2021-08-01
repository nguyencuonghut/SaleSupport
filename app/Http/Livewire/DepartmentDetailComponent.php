<?php

namespace App\Http\Livewire;

use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class DepartmentDetailComponent extends Component
{
    use WithPagination;
    public $department_id;
    public $search;
    public $sortField;
    public $sortAsc;

    public function mount($department_id)
    {
        $department = Department::findOrFail($department_id);
        $this->department_id = $department->id;
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

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        //TODO: need to check auth user before deleting
        $user->delete();
        Session::flash('success_message', 'Xóa người dùng thành công!');
        return redirect()->route('admin.users');
    }

    public function render()
    {
        $department = Department::findOrFail($this->department_id);
        $users = User::where('department_id', $department->id)
                    ->where('name', 'like', '%'.$this->search.'%')
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate(10);
        return view('livewire.department-detail-component', ['department' => $department, 'users' => $users])->layout('layouts.base');
    }
}
