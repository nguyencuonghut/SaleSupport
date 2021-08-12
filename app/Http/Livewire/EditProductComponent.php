<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class EditProductComponent extends Component
{
    public $product_id;
    public $code;
    public $weight;

    public function mount($product_id)
    {
        $this->product_id = $product_id;
        $product = Product::findOrFail($product_id);
        $this->code = $product->code;
        $this->weight = $product->weight;
    }

    public function editProduct()
    {
        $rules = [
            'code'                  => 'required',
            'weight'                => 'required|integer'
        ];
        $messages = [
            'code.required' => 'Bạn phải nhập mã.',
            'weight.required' => 'Bạn phải chọn quy cách.',
            'weight.integer' => 'Bạn phải điền số cho quy cách.'
        ];
        $this->validate($rules,$messages);

        $product = Product::findOrFail($this->product_id);
        $product->code = $this->code;
        $product->weight = $this->weight;
        $product->save();

        Session::flash('success_message', 'Sản phẩm được sửa thành công!');
        return redirect()->route('admin.products');
    }

    public function render()
    {
        return view('livewire.edit-product-component')->layout('layouts.base');
    }
}
