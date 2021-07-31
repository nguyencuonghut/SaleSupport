<?php

namespace App\Http\Livewire;

use App\Models\Department;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class DepartmentDetailComponent extends Component
{
    use WithPagination;
    public $department_id;
    public $search;

    public function mount($department_id)
    {
        $department = Department::findOrFail($department_id);
        $this->department_id = $department->id;
        $this->search = '';
    }

    public function render()
    {
        $department = Department::findOrFail($this->department_id);
        $users = User::where('department_id', $department->id)
                    ->where('name', 'like', '%'.$this->search.'%')
                    ->paginate(10);
        return view('livewire.department-detail-component', ['department' => $department, 'users' => $users])->layout('layouts.base');
    }
}
