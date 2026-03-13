<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login() {
        return view('auth.login_frm');
    }

    public function loginSubmit(Request $request) {
        echo "Login submit!!!";
    }

    public function logout() {
        // logout de usuário autenticado 
    }
}
