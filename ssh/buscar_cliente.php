<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "dni";
$password = "MinuzaFea265/";
$database = "doblenet";

// Obtener el número de cliente enviado desde el formulario
if (isset($_POST['no_cliente'])) {
    $no_cliente = $_POST['no_cliente'];

    // Crear la conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $database);

    // Verificar si la conexión fue exitosa
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta SQL para buscar al cliente por su número de cliente
    $sql = "SELECT nombre, ip FROM clientes WHERE no_cliente = $no_cliente";

    // Ejecutar la consulta
    $result = $conn->query($sql);

    // Verificar si se encontraron resultados
    if ($result->num_rows > 0) {
        // Obtener los datos del cliente
        $row = $result->fetch_assoc();
        $nombre = $row["nombre"];
        $ip = $row["ip"];

        // Devolver los datos en formato JSON
        echo json_encode([
            'success' => true,
            'nombre' => $nombre,
            'ip' => $ip
        ]);
    } else {
        // El cliente no fue encontrado en la base de datos
        echo json_encode([
            'success' => false,
            'message' => 'Cliente no encontrado en la base de datos.'
        ]);
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // No se recibió el número de cliente desde el formulario
    echo json_encode([
        'success' => false,
        'message' => 'No se proporcionó el número de cliente.'
    ]);
}
?>
