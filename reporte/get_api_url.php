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

// Obtener la URL de la API de la tabla apiKey
$sql = "SELECT url FROM apiKey";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Solo se espera un único resultado
    $row = $result->fetch_assoc();
    $apiUrl = $row["url"];

    // Devuelve la URL de la API
    echo $apiUrl;
} else {
    // No se encontró ninguna URL de la API
    echo "Error: No se encontró ninguna URL de la API en la base de datos.";
}

// Cerrar la conexión
$conn->close();
?>
