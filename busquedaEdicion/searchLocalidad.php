<?php
// Configuración de la conexión a la base de datos (ajusta según tus credenciales)

$servername = "localhost";
$username = "dni";
$password = "MinuzaFea265/";
$dbname = "doblenet";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comunidad = $_POST["comunidad"]; // Aquí se corrige el nombre del campo

    $sql = "SELECT * FROM clientes WHERE localidad LIKE '%$comunidad%'"; // También se cambia localidad por comunidad
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div id='userInfo'>";
            echo "<p><strong>Nombre:</strong> " . $row["nombre"] . "</p>";
            echo "<p><strong>Dirección:</strong> " . $row["direccion"] . "</p>";
            echo "<p><strong>Teléfono:</strong> " . $row["telefono"] . "</p>";
            echo "<p><strong>Fecha de Instalación:</strong> " . $row["fechaInstalacion"] . "</p>";
            echo "<p><strong>Equipos:</strong> " . $row["equipos"] . "</p>";
            echo "<p><strong>Localidad:</strong> " . $row["localidad"] . "</p>";
            echo "<button onclick='editarUsuario(" . $row["id_cliente"] . ")'>Editar</button>";
            echo "<button onclick='eliminarUsuario(" . $row["id_cliente"] . ")'>Eliminar</button>";
            echo "</div>";
        }
    } else {
        echo "<p>No se encontraron resultados.</p>";
    }
}

// Cierre de la conexión a la base de datos
$conn->close();
?>
