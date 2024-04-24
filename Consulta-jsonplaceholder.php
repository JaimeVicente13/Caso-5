<?php

// Array con los IDs de los posts que deseas obtener información
$post_ids = [1, 2, 3];

echo "<table border='1'>";
echo "<tr><th>ID</th><th>Título</th><th>Cuerpo</th></tr>";

foreach ($post_ids as $post_id) {
    // URL de la API REST para obtener información sobre el post específico
    $url = "https://jsonplaceholder.typicode.com/posts/$post_id";

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
    $post_data = json_decode(trim($response), true);

    // Verificar si la decodificación fue exitosa
    if($post_data === null && json_last_error() !== JSON_ERROR_NONE) {
        // Manejar el error de decodificación JSON como desees
        echo "Error al decodificar la respuesta JSON";
        // Puedes agregar un código de estado HTTP apropiado aquí, como 500
        exit;
    }

    // Mostrar la información del post en una fila de la tabla
    echo "<tr>";
    echo "<td style='text-align:center;'>" . $post_data['id'] . "</td>";
    echo "<td style='text-align:center;'>" . $post_data['title'] . "</td>";
    echo "<td style='text-align:center;'>" . $post_data['body'] . "</td>";
    echo "</tr>";

    // Cerrar la sesión cURL
    curl_close($curl);
}

echo "</table>";

?>
