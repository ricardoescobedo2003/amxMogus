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

// Verificar si se proporcionó una URL en el formulario
if(isset($_POST['apiUrl']) && !empty($_POST['apiUrl'])) {
    // Obtener la URL de la API del formulario
    $url = $_POST['apiUrl'];

    // Preparar la consulta SQL para insertar la URL en la tabla apiKey
    $sql = "INSERT INTO apiKey (url) VALUES ('$url')";

    // Ejecutar la consulta y verificar si fue exitosa
    if ($conn->query($sql) === TRUE) {
        echo "URL de la API guardada correctamente.";
    } else {
        echo "Error al guardar la URL de la API: " . $conn->error;
    }
} else {
    echo "No se proporcionó ninguna URL de API en el formulario.";
}

// Cerrar la conexión
$conn->close();
?>
