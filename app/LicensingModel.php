<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LicensingModel extends Model
{
    protected $table = 'licensing_table';

    protected $fillable = [
        'licensing', 'company_id',
    ];
}
