<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Livewire\WithPagination;

class ProductComponent extends Component
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


    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        //TODO: need to check auth user before deleting
        $product->delete();
        Session::flash('success_message', 'Xóa sản phẩm thành công!');
        return redirect()->route('admin.products');
    }

    public function render()
    {
        $products = Product::where('id', 'like', '%'.$this->search.'%')
                    ->orWhere('code', 'like', '%'.$this->search.'%')
                    ->orWhere('name', 'like', '%'.$this->search.'%')
                    ->orWhere('weight', 'like', '%'.$this->search.'%')
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate(10);
        return view('livewire.product-component', ['products' => $products])->layout('layouts.base');
    }
}
