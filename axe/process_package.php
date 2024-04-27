<?php
// Conexión a la base de datos (cambia los datos según tu configuración)
$servername = "localhost";
$username = "dni";
$password = "MinuzaFea265/";
$dbname = "doblenet";

// Obtener datos del formulario
$packageName = $_POST['packageName'];
$packagePrice = $_POST['packagePrice'];

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Preparar la consulta SQL para insertar el paquete en la tabla
$sql = "INSERT INTO paquetes (paquete, precio) VALUES ('$packageName', '$packagePrice')";

if ($conn->query($sql) === TRUE) {
    echo "Paquete agregado correctamente";
} else {
    echo "Error al agregar el paquete: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
