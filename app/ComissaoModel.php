<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComissaoModel extends Model
{
    protected $table = 'comission_table';

    protected $fillable = [
        'user_id', 'company_id', 'client_id', 'informacoes', 'value', 'description',
    ];
}
