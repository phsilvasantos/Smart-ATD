<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesModel extends Model
{
    //
    protected $table = 'sales_table';

    protected $fillable = [
        'user_id', 'company_id', 'client_id', 'informacoes',
    ];
}
