<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsGroupModel extends Model
{
    //
    protected $table = 'products_group_table';

    protected $fillable = [
        'name', 'description', 'company_id',
    ];
}
