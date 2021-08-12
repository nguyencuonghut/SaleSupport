<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class AddProductComponent extends Component
{
    public $code;
    public $weight;

    public function addProduct()
    {
        $rules = [
            'code'                  => 'required|unique:products',
            'weight'                => 'required|integer'
        ];
        $messages = [
            'code.required' => 'Bạn phải nhập mã.',
            'code.unique' => 'Mã đã tồn tại. Bạn hãy chọn mã khác.',
            'weight.required' => 'Bạn phải chọn quy cách.',
            'weight.integer' => 'Bạn phải điền số cho quy cách.'
        ];
        $this->validate($rules,$messages);

        $product = new Product();
        $product->code = $this->code;
        $product->weight = $this->weight;
        $product->save();

        Session::flash('success_message', 'Sản phẩm mới được tạo thành công!');
        return redirect()->route('admin.products');
    }

    public function render()
    {
        return view('livewire.add-product-component')->layout('layouts.base');
    }
}
