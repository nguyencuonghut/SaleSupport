<?php

namespace App\Http\Livewire;

use App\Models\Department;
use Livewire\Component;

class DepartmentComponent extends Component
{
    public function render()
    {
        $departments = Department::all();
        return view('livewire.department-component', ['departments' => $departments])->layout('layouts.base');
    }
}
