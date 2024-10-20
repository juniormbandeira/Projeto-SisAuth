<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
</head>
<body>
    <h1>Editar Usuário</h1>
    <!-- View de edição de usuários -->
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

       <!-- Exibe o perfil admin apenas para administradores -->
        @if (Auth::user()->role === 'admin')
        <div>
            <label for="role">Perfil:</label>
               <select name="role" id="role">
               <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>Usuário</option>
               <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrador</option>
            </select>
            </div>
        @else
        <div>
            <label for="role">Papel:</label>
            <select id="role" name="role">
                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>Usuário</option>
                <a href="{{ route('users.index') }}">Voltar à página inicial</a>
            </select>
        </div>
        @endif

        <button type="submit">Salvar</button>
    </form>

   <a href="{{ route('users.index') }}">Clique aqui para Voltar</a>
</body>
</html>
