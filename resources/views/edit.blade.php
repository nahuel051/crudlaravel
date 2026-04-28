<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
</head>
<body>
    //form action="/players/{{ $player->id }}" para enviar la solicitud de actualización al controlador correspondiente
    <form action="/players/{{ $player->id }}" method="post">
        @csrf
        @method('PUT')
        //value="{{ old('nombre', $player->nombre) }}" para mantener el valor del campo después de enviar el formulario, utilizando el valor antiguo o el valor actual del jugador
        <input type="text" name="nombre" value="{{ old('nombre', $player->nombre) }}" placeholder="Nombre de jugador">
        <input type="number" name="edad" value="{{ old('edad', $player->edad) }}" placeholder="Edad">
                       <select name="team_id">
            <option value="">Seleccionar equipo</option>
            @foreach ($teams as $team)
            //value="{{ $team->id }}" {{ old('team_id', $player->team_id) == $team->id ? 'selected' : '' }} para mantener la selección del equipo después de enviar el formulario, comparando el valor antiguo o el valor actual del jugador con el id del equipo
            //== $team->id ? 'selected' : ''Compara y agrega el atributo selected si coincide; si no, retorna cadena vacía
                <option value="{{ $team->id }}" {{ old('team_id', $player->team_id) == $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
            @endforeach
        </select>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>