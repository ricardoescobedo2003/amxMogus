<?php
$servername = "localhost";
$username = "dni";
$password = "MinuzaFea265/";
$dbname = "doblenet";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT localidad FROM comunidad";
$result = $conn->query($sql);

$communities = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $communities[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($communities);
?>
