<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


Route::get('/', function () {
    // testar a conexão com a base de dados

    try {

        DB::connection()->getPdo();
        echo 'Conexão, ok!';
        
    } catch (Exception $e) {
        echo 'Não foi possível conectar com o banco de dados! Erro: '. $e->getMessage();
    }
});
