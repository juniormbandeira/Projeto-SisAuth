<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Primeira function, a roda deverá ser usada para cadastrar o administrador
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // função para inserir usuários via register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:user,admin',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('login')->with('success', 'Usuário inserido com sucesso!');
    }

    // Função verifica se usuário é adminstrador, em caso positivo, traz todos os usuários.
    // Em caso negativo, só traz os dados do usuário que está autenticando.
    // Somente administradores podem criar/editar/atualizar usuários.
    // BUSCAR TODOS

    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // Para administradores, retorna todos os usuários
            $users = User::all();
        } else {
            // Para usuários normais, retorna apenas seu próprio registro
            $users = User::where('id', $user->id)->get();
        }

        return view('users.index', compact('users'));
    }


    // Função para chamar a view de criação de usuários, somente quando administrador estiver logado.
    // CHAMA VIEW DE CRIAÇÃO
    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/home')->with('error', 'Você não tem permissão para acessar esta página.');
        }

        return view('users.create');
    }

    // Função para gravar novo usuário na base de dados.
    public function store(Request $request)
    {
        // Valida os dados do formulário
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
        ]);

        // Cria o novo usuário no banco de dados
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = bcrypt($validatedData['password']);
        $user->role = $validatedData['role'];
        $user->save();

        // Redireciona para a lista de usuários com uma mensagem de sucesso
        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso!');
    }


    // Função para abrir a edição de usuário, caso logado seja Administrador
    // CHAMA VIEW DE EDIÇÃO
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // Função para atualizar usuário: UPDATE
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:user,admin',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso.');
    }

    // Função que remove usuário por ID : DELETAR
    public function destroy($id)
    {
        $user = Auth::user();

        if ($user->role === 'admin' || $user->id == $id) {
            User::destroy($id);
            return redirect()->route('users.index')->with('success', 'Usuário deletado com sucesso.');
        }

        return redirect()->route('users.index')->withErrors(['delete' => 'Você não pode deletar este usuário.']);
    }
}
