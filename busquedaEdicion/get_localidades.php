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

// Consulta SQL para obtener las localidades
$sql = "SELECT localidad FROM comunidad";
$result = $conn->query($sql);

$localidades = [];

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $localidades[] = $row["localidad"];
    }
}

// Cerrar conexión
$conn->close();

// Devolver las localidades como JSON
echo json_encode($localidades);

?>
