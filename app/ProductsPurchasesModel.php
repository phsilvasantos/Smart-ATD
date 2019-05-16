<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsPurchasesModel extends Model
{
    //

    protected $table = 'products_purchases_table';

    protected $fillable = [
        'price', 'qtd', 'purchase_id','product_id', 'company_id',
    ];
}
