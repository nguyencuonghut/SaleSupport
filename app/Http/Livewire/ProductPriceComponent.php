<?php

namespace App\Http\Livewire;

use App\Models\Price;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ProductPriceComponent extends Component
{

    use WithPagination;
    public $product_id;
    public $search;
    public $sortField;
    public $sortAsc;

    public function mount($product_id)
    {
        $product = Product::findOrFail($product_id);
        $this->product_id = $product->id;
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

    public function exportExcel()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');

    }

    public function exportPdf()
    {
        return Excel::download(new ProductsExport, 'products.pdf');
    }

    public function render()
    {
        $product = Product::findOrFail($this->product_id);
        $prices = Price::where('product_id', $product->id)
                    ->where('discount', 'like', '%'.$this->search.'%')
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate(10);
        return view('livewire.product-price-component', ['product' => $product, 'prices' => $prices])->layout('layouts.base');
    }
}
