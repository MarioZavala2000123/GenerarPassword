<?php
// Función para generar contraseñas
function generarContraseña($longitud = 12) {
    $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*';
    $contraseña = '';
    $max = strlen($caracteres);

    for ($i = 0; $i < $longitud; $i++) {
        $contraseña .= $caracteres[mt_rand(0, $max)];
    }

    return $contraseña;
}

// Verificar la solicitud HTTP
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $longitud = isset($_GET['longitud']) ? $_GET['longitud'] : 12;

    if ($longitud === '') {
        // Verificar si tiene contraseña almacenada
        http_response_code(500);
        echo json_encode(array('error' => 'No se pudo generar la contraseña.'));
    } else {
        // Si la contraseña está llena, realiza el proceso

        // Generar una contraseña con la longitud
        $contraseñaSegura = generarContraseña($longitud);
        // Devolver la contraseña generada como respuesta JSON
        header('Content-Type: application/json');
        echo json_encode(['Password' => $contraseñaSegura]);
    }
} else {
    // Devolver un error en caso de que el método de solicitud no sea GET
    header('Content-Type: application/json');
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
}
