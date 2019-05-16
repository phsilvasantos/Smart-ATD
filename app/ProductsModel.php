<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsModel extends Model
{
    //
    protected $table = 'products_table';

    protected $fillable = [
        'name', 'code', 'barcode', 'nfe', 'margin', 'taxes', 'sale_value', 'cost_value', 'provider_id', 'product_group_id', 'company_id',
    ];
}
