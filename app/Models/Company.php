<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;


    // relação de empresa para usuários. Uma empresa pode ter vários usuários
    public function users(){
        return $this->hasMany(User::class, 'id_company');
    }

    // relação de empresa para as filas de espera. Uma empresa pode ter vários filas de espera
    public function queues(){
        return $this->hasMany(Queue::class, 'id_company');
    }

    //  relação entre empresa e bundles. Uma empresa pode ter vários bundles 

    public function bundles() {
        return $this->hasMany(Bundle::class, 'id_company');
    }
}
