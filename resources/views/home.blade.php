<!-- resources/views/home.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Página Inicial</title>
</head>
<body>
    <!-- View da página principal, aparece para o perfil user -->
    @if(session('user_role'))
       <p>Nível de Permissão: {{ session('user_role') }}</p>
    @endif
    <h1>Bem-vindo à Página Inicial!</h1>
    <a href="{{ route('users.index') }}">Para ver seu cadastro, clique aqui</a>
</body>
</html>
