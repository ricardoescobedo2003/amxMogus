<?php
// Obtener datos del formulario
$username = $_POST['username'];
$password = $_POST['password'];
$ap = $_POST['ap'];

// Procesar los datos como sea necesario
// Por ejemplo, guardarlos en la base de datos
// Aquí debes agregar la lógica para guardar los datos en tu base de datos
// Reemplaza las siguientes líneas con tu código de conexión y consulta SQL

// Conexión a la base de datos
$servername = "localhost";
$username = "tu_usuario";
$password = "tu_contraseña";
$dbname = "tu_base_de_datos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Ejemplo de consulta SQL para insertar datos en una tabla "aps"
$sql = "INSERT INTO aps (nombre, ip) VALUES ('$ap', '192.168.1.1')"; // Cambia '192.168.1.1' por la IP que desees

if ($conn->query($sql) === TRUE) {
    echo "Usuario creado exitosamente.";
} else {
    echo "Error al crear el usuario: " . $conn->error;
}

// Cerrar conexión
$conn->close();
?>
