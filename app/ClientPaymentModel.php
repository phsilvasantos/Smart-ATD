<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientPaymentModel extends Model
{
    protected $table = 'client_payment_table';

    protected $fillable = [
        'value', 'debit_id', 'company_id',
    ];
}
