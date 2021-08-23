<?php

namespace App\Http\Livewire;

use App\Exports\PolicyExport;
use App\Models\Policy;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;


class PolicyComponent extends Component
{
    use WithPagination;

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


    public function deletePolicy($id)
    {
        $policy = Policy::findOrFail($id);
        //TODO: need to check auth user before deleting
        $policy->delete();
        Session::flash('success_message', 'Xóa chính sách thành công!');
        return redirect()->route('admin.policies');
    }

    public function exportExcel()
    {
        return Excel::download(new PolicyExport, 'policy.xlsx');
    }

    public function exportPdf()
    {
        return Excel::download(new PolicyExport, 'policy.pdf');
    }

    public function render()
    {
        $policies = Policy::where('id', 'like', '%'.$this->search.'%')
                    ->orWhere('name', 'like', '%'.$this->search.'%')
                    ->orWhere('content', 'like', '%'.$this->search.'%')
                    ->orWhere('date_range', 'like', '%'.$this->search.'%')
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate(10);
        return view('livewire.policy-component', ['policies' => $policies])->layout('layouts.base');
    }
}
