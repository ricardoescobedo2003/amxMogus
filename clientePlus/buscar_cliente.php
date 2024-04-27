<?php
$servername = "localhost";
$username = "dni";
$password = "MinuzaFea265/";
$dbname = "doblenet";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$clienteNo = $_POST['clienteNo'];

$sql = "SELECT * FROM clientes WHERE no_cliente = '$clienteNo'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<p><strong>Nombre:</strong> " . $row["nombre"] . "</p>";
    echo "<p><strong>Dirección:</strong> " . $row["direccion"] . "</p>";
    echo "<p><strong>Mensualidad:</strong> $" . $row["mensualidad"] . "</p>";
    echo "<p><strong>Localidad:</strong> " . $row["localidad"] . "</p>";
} else {
    echo "No se encontró ningún cliente con el número proporcionado.";
}

$conn->close();
?>
