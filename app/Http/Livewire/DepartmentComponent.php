<?php

namespace App\Http\Livewire;

use App\Models\Department;
use Livewire\Component;

class DepartmentComponent extends Component
{
    public $search;

    public function mount()
    {
        $this->search = '';
    }
    public function render()
    {
        $departments = Department::where('id', 'like', '%'.$this->search.'%')
                                ->orWhere('code', 'like', '%'.$this->search.'%')
                                ->orWhere('name', 'like', '%'.$this->search.'%')
                                ->orderBy('id', 'desc')
                                ->get();
        return view('livewire.department-component', ['departments' => $departments])->layout('layouts.base');
    }
}
