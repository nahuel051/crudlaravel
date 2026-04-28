<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Futbol</title>
</head>
<body>
    <form action="/players/search" method="get" style="margin-bottom: 1rem;">
        //value="{{ request('search') }}" para mantener el valor de búsqueda después de enviar el formulario
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por nombre o edad">
        <button type="submit">Buscar</button>
        <a href="/players" style="margin-left: 1rem;">Limpiar</a>
        <a href="/teams" style="margin-left: 1rem;">Equipos</a>

    </form>

    <form action="/players" method="post">
        @csrf
        <input type="text" name="nombre" placeholder="Nombre de jugador">
        <input type="number" name="edad" placeholder="Edad">
        <select name="team_id">
            <option value="">Seleccionar equipo</option>
            //foreach para mostrar los equipos disponibles en el formulario de creación de jugadores
            @foreach ($teams as $team)
            //option para mostrar el nombre del equipo y su id como valor en el select
                <option value="{{ $team->id }}">{{ $team->name }}</option>
            @endforeach
        </select>
        <button type="submit">Enviar</button>
    </form>
    <h2>Jugadores:</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Equipo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($players as $player)
                <tr>
                    <td>{{ $player->id }}</td>
                    <td>{{ $player->nombre }}</td>
                    <td>{{ $player->edad }}</td>
                    <td>{{ $player->team?->name ?? 'Sin equipo' }}</td>
                    <td>
                        //action="/players/{{ $player->id }}" para enviar la solicitud de eliminación al controlador correspondiente
                        <form action="/players/{{ $player->id }}" method="post" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                        //enlace para editar el jugador, redirigiendo a la vista de edición con el id del jugador
                        <a href="/players/{{ $player->id }}/edit">Editar</a>
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>