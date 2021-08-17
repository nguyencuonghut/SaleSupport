<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Cart;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class UserAddOrderComponent extends Component
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

    public function addToCart($product_id)
    {
        $product = Product::findOrFail($product_id);
        Cart::add($product->id,
                 $product->code,
                 1,
                 $product->last_price->company_price,
                 ['warehouse_price' => $product->last_price->warehouse_price,
                 'ht_warehouse_price' => $product->last_price->warehouse_price
                 ])->associate('App\Models\Product');
        $this->emitTo('cart-count-component', 'refreshComponent');
        return redirect()->back();
    }

    public function render()
    {
        $products = Product::where('id', 'like', '%'.$this->search.'%')
                    ->orWhere('code', 'like', '%'.$this->search.'%')
                    ->orWhere('weight', 'like', '%'.$this->search.'%')
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate(10);
        return view('livewire.user-add-order-component', ['products' => $products])->layout('layouts.base');
    }
}
