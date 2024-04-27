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

// Consultar las localidades
$sql = "SELECT id_comunidad, localidad FROM comunidad";
$result = $conn->query($sql);

// Almacenar resultados en un array
$localidades = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $localidades[] = $row;
    }
}

// Cerrar la conexión
$conn->close();

// Enviar resultados como JSON
header('Content-Type: application/json');
echo json_encode($localidades);
?>
