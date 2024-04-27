<?php
$servername = "localhost";
$username = "dni";
$password = "MinuzaFea265/";
$dbname = "doblenet";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$fechaInicio = $_POST['fechaInicio'];
$fechaFin = $_POST['fechaFin'];

$sql = "SELECT SUM(monto) AS total_recaudado FROM pagos WHERE fecha BETWEEN '$fechaInicio' AND '$fechaFin'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_recaudado = $row['total_recaudado'];
} else {
    $total_recaudado = "0.00";
}

$conn->close();

echo "Total recaudado entre $fechaInicio y $fechaFin: $total_recaudado";
?>
