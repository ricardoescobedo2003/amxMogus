<?php
// Establecer conexión con la base de datos (modifica los datos según tu configuración)
$servername = "localhost";
$username = "dni";
$password = "MinuzaFea265/";
$dbname = "doblenet";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Consulta SQL para obtener los paquetes y precios
$sql = "SELECT paquete, precio FROM paquetes";
$result = $conn->query($sql);

$paquetes = array();

if ($result->num_rows > 0) {
    // Agregar cada fila de resultados al array de paquetes
    while ($row = $result->fetch_assoc()) {
        $paquete = array(
            "paquete" => $row["paquete"],
            "precio" => $row["precio"]
        );
        array_push($paquetes, $paquete);
    }
}

// Convertir el array de paquetes a formato JSON y enviarlo como respuesta
echo json_encode($paquetes);

// Cerrar conexión
$conn->close();
?>
