<?php
// Get selected client details from the database
$selectedCliente = $_POST['clientes'];

// Connect to your database
$servername = "localhost";
$username = "dni";
$password = "MinuzaFea265/";
$dbname = "doblenet";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get client details
$sql = "SELECT no_cliente, nombre, mensualidad FROM clientes WHERE no_cliente = $selectedCliente";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $no_cliente = $row["no_cliente"];
        $nombre = $row["nombre"];
        $mensualidad = $row["mensualidad"];
        $fecha = date("Y-m-d");
    }
} else {
    echo "0 results";
}

// Insert payment details into the 'pagos' table
$insert_sql = "INSERT INTO pagos (no_cliente, nombre, fecha, monto) VALUES ($no_cliente, '$nombre', '$fecha', $mensualidad)";
if ($conn->query($insert_sql) === TRUE) {
    echo "Pago registrado correctamente";
} else {
    echo "Error: " . $insert_sql . "<br>" . $conn->error;
}

$conn->close();
?>
