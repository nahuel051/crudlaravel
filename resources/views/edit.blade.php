<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
</head>
<body>
    <form action="/players/{{ $player->id }}" method="post">
        @csrf
        @method('PUT')
        <input type="text" name="nombre" value="{{ old('nombre', $player->nombre) }}" placeholder="Nombre de jugador">
        <input type="number" name="edad" value="{{ old('edad', $player->edad) }}" placeholder="Edad">
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>