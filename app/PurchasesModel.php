<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchasesModel extends Model
{
    //
    protected $table = 'purchases_table';

    protected $fillable = [
        'note_number', 'date', 'provider_id', 'company_id',
    ];
}
