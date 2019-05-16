<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillsModel extends Model
{
    protected $table = 'bills_table';

    protected $fillable = [
        'value', 'description','type', 'venc_date', 'company_id', 'user_id',
    ];
}
