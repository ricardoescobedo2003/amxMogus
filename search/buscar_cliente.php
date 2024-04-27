<?php
// Conexión a la base de datos (ajusta los detalles según tu configuración)
$servername = "localhost";
$username = "dni";
$password = "MinuzaFea265/";
$dbname = "doblenet";

// Obtener el ID del cliente enviado desde el formulario
$id_cliente = $_POST['id_cliente'];

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta SQL para obtener la información del cliente según el ID proporcionado
$sql = "SELECT * FROM clientes WHERE idc = '$id_cliente'";
$result = $conn->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Nombre</th><th>Dirección</th><th>Teléfono</th><th>Fecha de Instalación</th><th>Equipos</th><th>Mensualidad</th><th>Localidad</th><th>Comentarios</th></tr>";
    // Mostrar los datos del cliente en filas de la tabla
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["nombre"] . "</td>";
        echo "<td>" . $row["direccion"] . "</td>";
        echo "<td>" . $row["telefono"] . "</td>";
        echo "<td>" . $row["fechaInstalacion"] . "</td>";
        echo "<td>" . $row["equipos"] . "</td>";
        echo "<td>" . $row["mensualidad"] . "</td>";
        echo "<td>" . $row["localidad"] . "</td>";
        echo "<td>" . $row["comentarios"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron resultados para el ID de cliente proporcionado.";
}

// Cerrar la conexión
$conn->close();
?>
