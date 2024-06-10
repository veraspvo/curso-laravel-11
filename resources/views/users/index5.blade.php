<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importar CSV</title>
</head>
<body>
    {{-- {{ dd($users) }};
    --}}
    {{-- Apresentar mensagem de erro se existir --}}
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    @endif

    <form action="{{ route('users5.import') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" id="file" accept=".csv">
        <button type="submit" id="fileBtn">Importar</button>
    </form>
    @foreach ($users as $user)
        <p>{{ $user->id }}</p>
    @endforeach
</body>
</html>