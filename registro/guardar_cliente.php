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

// Obtener datos del formulario
$idc = $_POST['idc'];
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$localidad = $_POST['localidad'];
$fechaInstalacion = $_POST['fechaInstalacion'];
$equipos = $_POST['equipos'];
$paquete = $_POST['paquete'];
$mensualidad = $_POST['mensualidad'];
$comentarios = $_POST['comentarios'];
$ip = $_POST['ip'];

// Preparar y ejecutar consulta SQL para insertar datos en la tabla clientes
$sql = "INSERT INTO clientes (no_cliente, nombre, direccion, telefono, localidad, fechaInstalacion, equipos, paquete, mensualidad, comentarios, ip) 
        VALUES ('$idc', '$nombre', '$direccion', '$telefono', '$localidad', '$fechaInstalacion', '$equipos', '$paquete', '$mensualidad', '$comentarios', '$ip')";

if ($conn->query($sql) === TRUE) {
    echo "Cliente guardado correctamente";
} else {
    echo "Error al guardar el cliente: " . $conn->error;
}

// Cerrar conexión
$conn->close();
?>
