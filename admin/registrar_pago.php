<?php
$servername = "localhost";
$username = "dni";
$password = "MinuzaFea265/";
$dbname = "doblenet";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener los datos del formulario de pago
$nombre = $_POST['nombre'];
$fecha = $_POST['fecha'];
$monto = $_POST['monto'];

// Realizar la inserción en la tabla pagos
$query = "INSERT INTO pagos (nombre, fecha, monto, sucursal) VALUES ('$nombre', '$fecha', '$monto', '$sucursal')";

if ($conn->query($query) === TRUE) {
    // Si el registro en la base de datos es correcto, enviar mensaje por WhatsApp
    $phone = "5214961121843";
    $message = urlencode("El cliente: $nombre realizó su pago con éxito el día $fecha por la cantidad de: $monto en la sucursal: $sucursal");
    $apikey = "4387760";
    $url = "https://api.callmebot.com/whatsapp.php?phone=$phone&text=$message&apikey=$apikey";

    $response = file_get_contents($url);

    if ($response === false) {
        echo "Error al enviar el mensaje por WhatsApp.";
    } else {
        echo "Pago registrado con éxito y mensaje enviado por WhatsApp.";
    }
} else {
    echo "Error al registrar el pago: " . $conn->error;
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
