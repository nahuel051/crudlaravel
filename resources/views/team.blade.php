<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipos</title>
</head>
<body>
    <form action="/teams" method="post">
        @csrf
        <input type="text" name="name" placeholder="Nombre del equipo">
        <button type="submit">Crear Equipo</button>
    </form>
    <h2>Equipos</h2>
    <ul>
        @foreach ($teams as $team)
            <li>{{ $team->name }}</li>
        @endforeach
    </ul>
</body>
</html>