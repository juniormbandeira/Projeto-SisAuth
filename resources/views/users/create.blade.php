<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Usuário</title>
</head>
<body>
   <!-- View de criação de usuários via Sistema -->
    <h1>Criar Usuário</h1>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Nome:</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="password">Senha:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <label for="role">Nível de Acesso:</label>
            <select name="role" id="role" required>
                <option value="user">Usuário</option>
                <option value="admin">Administrador</option>
            </select>
        </div>
        <div>
            <button type="submit">Criar Usuário</button>
        </div>
    </form>
    <a href="{{ route('users.index') }}">Clique aqui para Voltar</a>
</body>
</html>
