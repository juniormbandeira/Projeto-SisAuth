<!DOCTYPE html>
<html>
    <!-- View de cadastro de usuários via register -->
<head>
    <title>Registrar</title>
</head>
<body>
    <h1>Registrar Usuários:</h1>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Nome" required>
        <input type="email" name="email" placeholder="E-mail" required>
        <input type="password" name="password" placeholder="Senha" required>
        <input type="password" name="password_confirmation" placeholder="Confirme a Senha" required>
        <select name="role" required>
            <option value="user">Usuário</option>
            <option value="admin">Administrador</option>
        </select>
        <button type="submit">Registrar</button>
    </form>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>
</html>
