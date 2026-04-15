<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primer formulario</title>
</head>
<body>
    <form action="/show" method="post">
         @csrf
    <p>Texto:</p>
    <input type="text" name="text" placeholder="Escribe algo...">
        <button type="submit">Enviar</button>
    </form>
    @if (!empty($text))
        <p>El texto ingresado es: {{ $text }}</p>
    @endif
</body>
</html>