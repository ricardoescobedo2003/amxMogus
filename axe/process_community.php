<?php
$servername = "localhost";
$username = "dni";
$password = "MinuzaFea265/";
$dbname = "doblenet";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el nombre de la comunidad del formulario
$communityName = $_POST['communityName'];

// Insertar el nombre de la comunidad en la tabla de la base de datos
$sql_insert_community = "INSERT INTO comunidad (localidad) VALUES ('$communityName')";

if ($conn->query($sql_insert_community) === TRUE) {
    echo "Comunidad agregada correctamente.";
} else {
    echo "Error al agregar la comunidad: " . $conn->error;
}

// Cerrar conexión
$conn->close();
?>
