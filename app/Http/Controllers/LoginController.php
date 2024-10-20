<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Função para mostrar o formulário de autenticação.
    public function showLoginForm()
    {
        return view('auth.login');
    }
    // Função que processa a requisição de autenticação.
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Armazena o nível de permissão na sessão
            session(['user_role' => $user->role]);

            if ($user->role === 'admin') {
                return redirect()->route('users.index'); // Redireciona para a lista de usuários
            }

            return redirect()->route('home'); // Redireciona para home
        }

        return redirect()->back()->withErrors(['email' => 'As credenciais não correspondem.']);
    }
}
