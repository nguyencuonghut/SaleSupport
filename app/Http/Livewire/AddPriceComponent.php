<?php

namespace App\Http\Livewire;

use App\Models\Price;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class AddPriceComponent extends Component
{
    public $product_id;
    public $discount;
    public $company_price;
    public $warehouse_price;
    public $ht_warehouse_price;

    public function addPrice()
    {
        $rules = [
            'product_id'            => 'required',
            'discount'              => 'required|integer',
            'company_price'         => 'required|integer',
            'warehouse_price'       => 'required|integer',
            'ht_warehouse_price'    => 'required|integer',
        ];
        $messages = [
            'product_id.required' => 'Bạn phải nhập mã sản phẩm.',
            'discount.required' => 'Bạn phải nhập giá trị Trừ trực tiếp.',
            'discount.integer' => 'Trừ trực tiếp phải là dạng số.',
            'company_price.required' => 'Bạn phải nhập giá trị cho Giá nhà máy.',
            'company_price.integer' => 'Giá nhà máy phải là dạng số.',
            'warehouse_price.required' => 'Bạn phải nhập giá trị cho Giá kho.',
            'warehouse_price.integer' => 'Giá kho phải là dạng số.',
            'ht_warehouse_price.required' => 'Bạn phải nhập giá trị cho Giá kho Hà Tĩnh.',
            'ht_warehouse_price.integer' => 'Giá kho Hà Tĩnh phải là dạng số.',
        ];
        $this->validate($rules,$messages);

        $price = new Price();
        $price->product_id = $this->product_id;
        $price->discount = $this->discount;
        $price->company_price = $this->company_price;
        $price->warehouse_price = $this->warehouse_price;
        $price->ht_warehouse_price = $this->warehouse_price;
        $price->save();

        Session::flash('success_message', 'Giá mới được tạo thành công!');
        return redirect()->route('admin.show.productprice', $price->product->id);
    }

    public function render()
    {
        $products = Product::orderBy('id', 'desc')->get();
        return view('livewire.add-price-component', ['products' => $products])->layout('layouts.base');
    }
}
