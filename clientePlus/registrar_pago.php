<?php
$servername = "localhost";
$username = "dni";
$password = "MinuzaFea265/";
$dbname = "doblenet";

// Conectarse a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$clienteNo = $_POST['clienteNoHidden']; // Utilizamos el clienteNoHidden que se estableció en el script.js
$noRecibo = $_POST['noRecibo'];
$fecha = date("Y-m-d"); // Obtenemos la fecha actual
$nombre = ''; // Inicializamos el nombre para poder obtenerlo de la base de datos más adelante
$monto = 0; // Inicializamos el monto para poder obtenerlo de la base de datos más adelante
$localidad = ''; // Inicializamos la localidad

// Obtener el nombre, monto y localidad del cliente desde la tabla clientes
$sql_cliente = "SELECT nombre, mensualidad, localidad FROM clientes WHERE no_cliente = '$clienteNo'";
$result_cliente = $conn->query($sql_cliente);

if ($result_cliente->num_rows > 0) {
    $row_cliente = $result_cliente->fetch_assoc();
    $nombre = $row_cliente["nombre"];
    $monto = $row_cliente["mensualidad"];
    $localidad = $row_cliente["localidad"];

    // Insertar los datos en la tabla pagos
    $sql_insert = "INSERT INTO pagos (no_cliente, nombre, fecha, monto, no_recibo) VALUES ('$clienteNo', '$nombre', '$fecha', '$monto', '$noRecibo')";

    if ($conn->query($sql_insert) === TRUE) {
        // Consultar la URL de la API en la tabla apiKey
        $sql_api_key = "SELECT url FROM apiKey";
        $result_api_key = $conn->query($sql_api_key);

        if ($result_api_key->num_rows > 0) {
            $row_api_key = $result_api_key->fetch_assoc();
            $url = $row_api_key['url'];

            // Construir el mensaje con los detalles del pago
            $message = "El cliente $nombre realizó su pago con éxito el día $fecha, por un monto de $monto con número de recibo $noRecibo en la localidad $localidad.";

            // Concatenar la URL de la API con el mensaje
            $urlWithMessage = $url . urlencode($message);

            // Enviar una solicitud a la URL resultante
            $response = file_get_contents($urlWithMessage);

            if ($response !== false) {
                echo "Pago registrado correctamente y mensaje enviado a la API Gracias por usar DoblenetSystem.";
            } else {
                echo "Pago registrado correctamente, pero error al enviar el mensaje a la API.";
            }
        } else {
            echo "No se encontró la URL de la API en la base de datos.";
        }
    } else {
        echo "Error al registrar el pago: " . $conn->error;
    }
} else {
    echo "No se encontró ningún cliente con el número proporcionado.";
}

// Cerrar la conexión
$conn->close();
?>
