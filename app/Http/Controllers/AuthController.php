<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login() {
        
        // Verifica se existem erros de validação de formulário
        if(session('errors')) {
            dd(session('errors')->all(), old());
        }
        
        return view('auth.login_frm');
    }

    public function loginSubmit(Request $request) {
       // form validation
        $request->validate(
            // regras de validação    
            [
                'username'  => 'required|email',
                'password'  => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{6,16}$/'
            ],
            // Mensagens de erro
            [
                'username.required' => 'O usuário é obrigatório.',
                'username.email'    => 'O usuário deve ser um e-mail válido.',
                'password.required' => 'A senha é obrigatória.',
                'password.regex'    => 'A senha deve conter entre 6 e 16 caracteres, ter ao menos uma letra maiúscula, uma minúscula e um dígito.' 
            ]
        );

        echo 'Ok';

    }

    public function logout() {
        // logout de usuário autenticado 
    }
}
