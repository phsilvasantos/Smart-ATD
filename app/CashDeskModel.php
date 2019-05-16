<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashDeskModel extends Model
{
    protected $table = 'cash_desk_table';

    protected $fillable = [
        'open_value', 'close_value', 'status', 'open_user_id', 'close_user_id', 'company_id',
    ];

}
