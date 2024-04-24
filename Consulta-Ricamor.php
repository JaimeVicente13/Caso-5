<?php

// Array con los IDs de los personajes que deseas obtener información
$character_ids = [1, 2, 3];

// Comienzo de la tabla
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Nombre</th><th>Especie</th><th>Imagen</th></tr>";

foreach ($character_ids as $character_id) {
    // URL de la API REST para obtener información sobre el personaje específico
    $url = "https://rickandmortyapi.com/api/character/$character_id";

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
    $character_data = json_decode(trim($response), true);

    // Verificar si la decodificación fue exitosa
    if($character_data === null && json_last_error() !== JSON_ERROR_NONE) {
        // Manejar el error de decodificación JSON como desees
        echo "Error al decodificar la respuesta JSON";
        // Puedes agregar un código de estado HTTP apropiado aquí, como 500
        exit;
    }

    // Obtener la URL de la imagen del personaje
    $character_image_url = $character_data['image'];

    // Mostrar la información del personaje en la tabla
    echo "<tr>";
    echo "<td style='text-align:center;'>" . $character_data['id'] . "</td>"; // Centrar el ID
    echo "<td style='text-align:center;'>" . $character_data['name'] . "</td>"; // Centrar el nombre
    echo "<td style='text-align:center;'>" . $character_data['species'] . "</td>"; // Centrar la especie
    echo "<td><img src='$character_image_url' alt='Imagen de $character_data[name]'></td>";
    echo "</tr>";

    // Cerrar la sesión cURL
    curl_close($curl);
}

// Fin de la tabla
echo "</table>";
?>