<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Índice de APIs</title>
    <style>
        /* Estilos para los botones */
        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #0329A9;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Índice de APIs</h1>
    <form method="get" action="Consulta-Ricamor.php">
        <button type="submit" name="api" value="rick_and_morty">Obtener datos de Rick and Morty</button>
    </form>
    <form method="get" action="Consulta-jsonplaceholder.php">
        <button type="submit" name="api" value="jsonplaceholder">Obtener datos de JSONPlaceholder</button>
    </form>
    <form method="get" action="Consulta-Pokemon.php">
        <button type="submit" name="api" value="pokemon">Obtener datos de Pokémon</button>
    </form>
</body>
</html>

