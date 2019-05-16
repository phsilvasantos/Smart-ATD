<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovementModel extends Model
{
    protected $table = 'movement_table';

    protected $fillable = [
        'value', 'description','payment_type', 'company_id',
    ];
}
