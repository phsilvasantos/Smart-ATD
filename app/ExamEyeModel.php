<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamEyeModel extends Model
{
    protected $table = 'exam_eye_table';
    protected $fillable = [
        'user_id', 'company_id', 'client_id', 'esf_od', 'esf_oe', 'cil_od', 'cil_oe', 'eix_od', 'eix_oe', 'dnp_od', 'dnp_oe', 'alt_od', 'alt_oe', 'adicao', 'responsavel', 'tipo_lente','sale_id', 'diabetes', 'hipertensao', 'gravida', 'cirurgia', 'oculos', 'pio_od', 'pio_oe', 'obs',
    ];
}
