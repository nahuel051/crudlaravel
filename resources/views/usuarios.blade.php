<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
</head>
<body>
    <form action="/usuarios" method="post">
        @csrf
        <input type="text" name="usuario" placeholder="Nombre de usuario"> 
        <input type="password" name="password" placeholder="Contraseña">
        <select name="id_rol" required>
            <option value="">Seleccionar rol</option>
            @foreach ($roles as $rol)
                <option value="{{ $rol->id }}">{{ $rol->nombre_rol }}</option>
            @endforeach
        </select>
        <button type="submit">Crear Usuario</button>
    </form>
    <h2>Usuarios</h2>
    <ul>
        @foreach ($usuarios as $usuario)
            <li>{{ $usuario->usuario }} - Rol: {{ $usuario->rol->nombre_rol }}</li>
        @endforeach
    </ul>
</body>
</html>