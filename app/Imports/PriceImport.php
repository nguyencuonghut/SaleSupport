<?php

namespace App\Imports;

use App\Models\Price;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PriceImport implements ToModel, WithHeadingRow
{
    function findProductId($name)
    {
        $product = Product::where('code', $name)->first();
        return $product->id;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Price([
            'product_id'            => $this->findProductId($row['ma_san_pham']),
            'discount'              => $row['tru_truc_tiep'],
            'company_price'         => $row['gia_nha_may'],
            'warehouse_price'       => $row['gia_kho'],
            'ht_warehouse_price'    => $row['gia_kho_ha_tinh'],
        ]);
    }
}
