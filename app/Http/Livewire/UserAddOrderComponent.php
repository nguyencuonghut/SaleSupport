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
    public $qty;
    public $createMode;
    public $product_id;

    public function mount()
    {
        $this->search = '';
        $this->sortField = 'id';
        $this->sortAsc = false;
        $this->qty = 0;
        $this->createMode = false;
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

    private function resetInputFields(){
        $this->qty = 0;
    }

    public function create($product_id)
    {
        $this->product_id = $product_id;
    }

    public function cancel()
    {
        $this->createMode = false;
        $this->resetInputFields();
    }

    public function store()
    {
        $rules = [
            'qty' => 'required|numeric|min:1',
        ];
        $messages = [
            'qty.required' => 'Bạn phải nhập số bao.',
            'qty.numeric' => 'Số bao phải là dạng số.',
            'qty.min' => 'Số bao ít nhất phải bằng 1.',
        ];
        $this->validate($rules,$messages);

        $product = Product::findOrFail($this->product_id);
        Cart::add(
            ['id' => $product->id,
            'name' => $product->code,
            'qty' => $this->qty,
            'price' => $product->last_price->company_price,
            'options' => [
                'warehouse_price' => $product->last_price->warehouse_price,
                'ht_warehouse_price' => $product->last_price->ht_warehouse_price,
                'weight' => $product->weight,
                'discount' => $product->last_price->discount
                ]
            ])->associate('App\Models\Product');

        $this->createMode = false;
        Session::flash('success_message', 'Thêm sản phẩm thành công!');
        $this->emitTo('cart-count-component', 'refreshComponent');
        $this->resetInputFields();
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
