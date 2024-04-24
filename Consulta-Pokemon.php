<?php

// Array con los números de los Pokémon que deseas obtener información
$pokemon_numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9];

// Comienzo de la tabla
echo "<table border='1'>";
echo "<tr><th>Nombre</th><th>ID</th><th>Peso</th><th>Altura</th><th>Imagen</th></tr>";

foreach ($pokemon_numbers as $pokemon_number) {
    // URL de la API REST para obtener información sobre el Pokémon específico
    $url = "https://pokeapi.co/api/v2/pokemon/$pokemon_number";

    // Inicializar cURL
    $curl = curl_init($url);

    // Configurar opciones de cURL
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    // Ejecutar la solicitud y obtener la respuesta
    $response = curl_exec($curl);

    // Verificar si hubo algún error en la solicitud
    if(curl_errno($curl)) {
        $error_message = curl_error($curl);
        // Manejar el error como desees, por ejemplo, mostrar un mensaje de error
        echo "Error en la solicitud: $error_message";
        // Puedes agregar un código de estado HTTP apropiado aquí, como 500
        exit;
    }

    // Obtener el código de estado HTTP de la respuesta
    $http_status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    // Verificar si la respuesta del servidor indica un error
    if($http_status_code >= 400) {
        // Manejar el error como desees, por ejemplo, mostrar un mensaje de error
        echo "Error en la solicitud: Código de estado HTTP $http_status_code";
        // Puedes agregar un código de estado HTTP apropiado aquí, como 500
        exit;
    }

    // Decodificar la respuesta JSON
    $pokemon_data = json_decode(trim($response), true);

    // Verificar si la decodificación fue exitosa
    if($pokemon_data === null && json_last_error() !== JSON_ERROR_NONE) {
        // Manejar el error de decodificación JSON como desees
        echo "Error al decodificar la respuesta JSON";
        // Puedes agregar un código de estado HTTP apropiado aquí, como 500
        exit;
    }

    // Obtener la URL de la imagen del Pokémon
    $pokemon_image_url = $pokemon_data['sprites']['front_default'];

    // Mostrar la información del Pokémon en la tabla
    echo "<tr>";
    echo "<td style='text-align:center;'>" . $pokemon_data['name'] . "</td>";
    echo "<td style='text-align:center;'>" . $pokemon_data['id'] . "</td>"; // Centrar el contenido de la columna "ID"
    echo "<td style='text-align:center;'>" . $pokemon_data['weight'] . "</td>"; // Centrar el contenido de la columna "Peso"
    echo "<td style='text-align:center;'>" . $pokemon_data['height'] . "</td>"; // Centrar el contenido de la columna "Altura"
    echo "<td><img src='$pokemon_image_url' alt='Imagen de $pokemon_data[name]'></td>";
    echo "</tr>";

    // Cerrar la sesión cURL
    curl_close($curl);
}

// Fin de la tabla
echo "</table>";
?>
