<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;
use Illuminate\Support\Facades\Session;

class UserCartComponent extends Component
{
    public $qty;
    public $updateMode = false;
    public $rowId;

    public function destroy($rowId)
    {
        Cart::remove($rowId);
        $this->emitTo('cart-count-component', 'refreshComponent');
        Session::flash('success_message', "Đã xóa sản phẩm khỏi giỏ hàng!");
    }

    public function destroyAll()
    {
        Cart::destroy();
        $this->emitTo('cart-count-component', 'refreshComponent');
        Session::flash('success_message', "Đã xóa tất cả sản phẩm khỏi giỏ hàng!");
        return redirect()->route('user.add.order');
    }

    private function resetInputFields(){
        $this->qty = 0;
    }

    public function edit($rowId)
    {
        $this->updateMode = true;
        $cart = Cart::get($rowId);
        $this->qty = $cart->qty;
        $this->rowId = $rowId;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
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


        Cart::update($this->rowId, $this->qty);

        $this->updateMode = false;
        Session::flash('success_message', 'Cập nhật thành công số bao');
        $this->emitTo('cart-count-component', 'refreshComponent');
        $this->resetInputFields();
    }

    public function render()
    {
        $subtotal_company = 0;
        $subtotal_warehouse = 0;
        $subtotal_ht_warehouse = 0;
        $subtotal_discount = 0;
        $total_weight = 0;

        foreach(Cart::content() as $item) {
            $subtotal_company += $item->qty * $item->options->weight * $item->price;
            $subtotal_warehouse += $item->qty * $item->options->weight * $item->options->warehouse_price;
            $subtotal_ht_warehouse += $item->qty * $item->options->weight * $item->options->ht_warehouse_price;
            $total_weight += $item->qty * $item->options->weight;

            $subtotal_discount += $item->qty * $item->options->weight * $item->options->discount;
            $subtotal_warehouse += $item->qty * $item->options->weight * $item->options->discount;
        }
        $total_qty = Cart::count();
        return view('livewire.user-cart-component',
                    ['subtotal_company' => $subtotal_company,
                    'subtotal_warehouse' => $subtotal_warehouse,
                    'subtotal_ht_warehouse' => $subtotal_ht_warehouse,
                    'total_weight' => $total_weight,
                    'total_qty' => $total_qty,
                    'subtotal_discount' => $subtotal_discount,
                    ])->layout('layouts.base');
    }
}
