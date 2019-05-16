<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelCompany extends Model
{
    //
    protected $table = 'company_table';

    protected $fillable = [
        'name', 'razao', 'cnpj', 'address','logo','city', 'cep', 'bairro', 'uf', 'service',
    ];
}
