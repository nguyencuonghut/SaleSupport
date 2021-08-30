<?php

namespace App\Http\Livewire;

use App\Exports\UsersExport;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class UserComponent extends Component
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
        $this->middleware('auth');
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

    public function exportExcel()
    {
        return Excel::download(new UsersExport, 'users.xlsx');

    }

    public function exportPdf()
    {
        return Excel::download(new UsersExport, 'users.pdf');
    }

    public function render()
    {
        $users = User::where('id', 'like', '%'.$this->search.'%')
                    ->orWhere('name', 'like', '%'.$this->search.'%')
                    ->orWhere('email', 'like', '%'.$this->search.'%')
                    ->orWhere('type', 'like', '%'.$this->search.'%')
                    ->orWhereHas('department', function($q)
                    {
                        $q->where('name', 'like', '%'.$this->search.'%');

                    })
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate(10);
        return view('livewire.user-component', ['users' => $users])->layout('layouts.base');
    }
}
