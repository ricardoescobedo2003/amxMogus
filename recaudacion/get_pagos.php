<?php
$servername = "localhost";
$username = "dni";
$password = "MinuzaFea265/";
$dbname = "doblenet";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM pagos ORDER BY fecha DESC"; // Ordenar por fecha de forma descendente
$result = $conn->query($sql);

$pagos = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pagos[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($pagos);
?>
