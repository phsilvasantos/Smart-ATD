<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InOutModel extends Model
{
    protected $table = 'in_out_table';

    protected $fillable = [
        'value', 'description','cash_desk_id', 'company_id', 'user_id',
    ];
}
