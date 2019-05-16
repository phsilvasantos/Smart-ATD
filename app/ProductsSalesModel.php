<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsSalesModel extends Model
{
    //

    protected $table = 'products_sales_table';

    protected $fillable = [
        'price', 'qtd', 'sale_id','product_id', 'company_id',
    ];

}
