<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Queue extends Model
{
    use SoftDeletes;




    // relação de fila de espera e a empresa. Uma fila de espera só pode pertencer a uma empresa
    public function company() {
        return $this->belongsTo(Company::class, 'id_company');
    }
}
