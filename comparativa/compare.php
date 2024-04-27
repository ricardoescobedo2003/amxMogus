<?php
$servername = "localhost";
$username = "dni";
$password = "MinuzaFea265/";
$dbname = "doblenet";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];

$sql = "SELECT id_cliente, nombre, direccion, telefono, mensualidad, localidad, paquete
        FROM clientes
        WHERE no_cliente NOT IN (
            SELECT DISTINCT no_cliente
            FROM pagos
            WHERE fecha BETWEEN '$fecha_inicio' AND '$fecha_fin'
        )";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Clientes que no tienen pagos en el rango de fechas especificado:</h2>";
    echo "<div class='table-container'>";
    echo "<table>";
    echo "<tr><th>ID Cliente</th><th>Nombre</th><th>Dirección</th><th>Teléfono</th><th>Mensualidad</th><th>Localidad</th><th>Paquete</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["id_cliente"]."</td>";
        echo "<td>".$row["nombre"]."</td>";
        echo "<td>".$row["direccion"]."</td>";
        echo "<td>".$row["telefono"]."</td>";
        echo "<td>".$row["mensualidad"]."</td>";
        echo "<td>".$row["localidad"]."</td>";
        echo "<td>".$row["paquete"]."</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
} else {
    echo "No se encontraron clientes que cumplan con los criterios especificados.";
}
$conn->close();
?>
