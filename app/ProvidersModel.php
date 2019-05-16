<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProvidersModel extends Model
{
    //
    protected $table = 'providers_table';

    protected $fillable = [
        'fantasy_name', 'social_name', 'type', 'status', 'address', 'number_address', 'bairro', 'city', 'rf_point', 'cep', 'phone', 'cell_phone', 'email', 'cpf', 'rg', 'nasc_date', 'bank_account', 'description', 'company_id',
    ];
}
