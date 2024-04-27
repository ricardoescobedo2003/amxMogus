<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "dni";
$password = "MinuzaFea265/";
$dbname = "doblenet";

// Crear conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos enviados por el formulario
$data = json_decode(file_get_contents('php://input'), true);

// Verificar que se hayan recibido los datos requeridos
if (isset($data['nombre'], $data['no_recibo'])) {
    $nombre = $data['nombre'];
    $no_recibo = $data['no_recibo'];

    // Consultar si el cliente existe en la tabla clientes
    $sql_check_client = "SELECT id_cliente, mensualidad FROM clientes WHERE nombre = '$nombre'";
    $result_check_client = $conn->query($sql_check_client);

    if ($result_check_client->num_rows > 0) {
        // El cliente existe, procedemos con el registro del pago
        $row = $result_check_client->fetch_assoc();
        $id_cliente = $row['id_cliente'];
        $mensualidad = $row['mensualidad'];

        // Obtener la fecha actual
        $fecha_actual = date('Y-m-d');

        // Insertar datos en la tabla de pagos
        $sql_insert_payment = "INSERT INTO pagos (no_cliente, nombre, fecha, monto, no_recibo) VALUES ('$id_cliente', '$nombre', '$fecha_actual', '$mensualidad', '$no_recibo')";

        if ($conn->query($sql_insert_payment) === TRUE) {
            // Consultar la URL de la API en la tabla apiKey
            $sql_api_key = "SELECT url FROM apiKey";
            $result_api_key = $conn->query($sql_api_key);

            if ($result_api_key->num_rows > 0) {
                $row_api_key = $result_api_key->fetch_assoc();
                $url = $row_api_key['url'];

                // Mensaje a enviar con la URL de la API
                $message = "El cliente: $nombre realizó su pago con éxito el día " . date('Y-m-d') . " por la cantidad de: $mensualidad con NO Recibo: $no_recibo.";

                // Concatenar la URL de la API con el mensaje
                $url2 = $url . urlencode($message);
                
                // Enviar el mensaje
                $response = file_get_contents($url2);

                if ($response !== false) {
                    echo json_encode(['message' => 'Pago registrado con éxito y mensaje enviado correctamente.']);
                } else {
                    echo json_encode(['message' => 'Pago registrado con éxito, pero error al enviar el mensaje.']);
                }
            } else {
                echo json_encode(['message' => 'No se encontró la URL de la API en la base de datos.']);
            }
        } else {
            echo json_encode(['message' => 'Error al registrar el pago en la base de datos: ' . $conn->error]);
        }
    } else {
        echo json_encode(['message' => 'El cliente no está registrado en la base de datos. No se puede procesar el pago.']);
    }
} else {
    echo json_encode(['message' => 'Falta información para procesar la solicitud.']);
}

// Cerrar la conexión
$conn->close();
?>
