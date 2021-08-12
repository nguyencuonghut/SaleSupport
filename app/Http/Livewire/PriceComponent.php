<?php

namespace App\Http\Livewire;

use App\Exports\PricesExport;
use App\Models\Price;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class PriceComponent extends Component
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


    public function exportExcel()
    {
        return Excel::download(new PricesExport, 'prices.xlsx');

    }

    public function exportPdf()
    {
        return Excel::download(new PricesExport, 'prices.pdf');
    }

    public function render()
    {
        $prices = Price::where('id', 'like', '%'.$this->search.'%')
                    ->orWhere('discount', 'like', '%'.$this->search.'%')
                    ->orWhere('company_price', 'like', '%'.$this->search.'%')
                    ->orWhere('warehouse_price', 'like', '%'.$this->search.'%')
                    ->orWhere('ht_warehouse_price', 'like', '%'.$this->search.'%')
                    ->orWhereHas('product', function($q)
                    {
                        $q->where('code', 'like', '%'.$this->search.'%');

                    })
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate(10);
        return view('livewire.price-component', ['prices' => $prices])->layout('layouts.base');
    }
}
