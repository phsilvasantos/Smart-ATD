<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientsModel extends Model
{
    //
    protected $table = 'clients_table';

    protected $fillable = [
        'name', 'type', 'status', 'address', 'number_address', 'bairro', 'city', 'rf_point', 'cep', 'phone', 'cell_phone', 'email', 'cpf', 'rg', 'nasc_date', 'description', 'company_id',
    ];
}
