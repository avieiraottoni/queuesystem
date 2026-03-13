<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\FactorY;

class AuthController extends Controller
{
    public function login() {
        
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

        // user authentication
        $user = User::where('email', trim($request->username))
            ->where('active', true)
            ->whereNull('deleted_at')
            ->where( function ($query) {
                $query->whereNull('blocked_until')
                    ->orWhere('blocked_until', '<', now());
            })->first();
        
        // Checar se o usuário e a senha batem com os dados informados.
        if($user && Hash::check(trim($request->password), $user->password)) {
            // login realizado com sucesso

        } else {
            die('Login inválido!');
        }

    }

    public function logout() {
        // logout de usuário autenticado 
    }
}
