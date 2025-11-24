<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu site Laravel</title>
</head>
<body>
    <nav>
    <!-- outros links -->
    <a href="{{ route('atividades.index') }}">Atividades</a>
</nav>
    @include('components.menu')
    <main>
        @yield('conteudo')
    </main>
</body>
</html>
