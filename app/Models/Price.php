<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;
    protected $table =  "prices";
    protected $fillable = [
        'product_id',
        'discount',
        'company_price',
        'warehouse_price',
        'ht_warehouse_price',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
