<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientDebitModel extends Model
{
    protected $table = 'client_debit_table';

    protected $fillable = [
        'value', 'payment_value', 'status', 'sale_id', 'client_id', 'venc_date', 'company_id',
    ];

}
