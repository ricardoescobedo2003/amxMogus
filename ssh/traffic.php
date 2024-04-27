<?php
// Datos de conexión SSH
$port = 22; // Puerto SSH (por defecto es 22)
$command = 'sudo tc qdisc add dev wlan0 root tbf rate 1mbit burst 32kbit latency 400ms'; // Comando para limitar el tráfico en wlan0

// Obtener el número de cliente enviado desde el formulario
if (isset($_POST['no_cliente'])) {
    $no_cliente = $_POST['no_cliente'];

    // Configuración de la conexión a la base de datos
    $servername = "localhost";
    $username_db = "dni";
    $password_db = "MinuzaFea265/";
    $database = "doblenet";

    // Crear la conexión a la base de datos
    $conn = new mysqli($servername, $username_db, $password_db, $database);

    // Verificar si la conexión fue exitosa
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta SQL para obtener la información de la antena (host, username, password)
    $sql = "SELECT ip, username, password FROM aps WHERE no_cliente = $no_cliente";

    // Ejecutar la consulta
    $result = $conn->query($sql);

    // Verificar si se encontraron resultados
    if ($result->num_rows > 0) {
        // Obtener los datos de la antena
        $row = $result->fetch_assoc();
        $host = $row["ip"];
        $username = $row["username"];
        $password = $row["password"];

        // Conexión SSH
        $connection = ssh2_connect($host, $port);
        if (!$connection) {
            die('Error al conectar al servidor SSH');
        }

        // Autenticación
        if (!ssh2_auth_password($connection, $username, $password)) {
            die('Error de autenticación SSH');
        }

        // Ejecutar comando SSH para limitar el tráfico en wlan0
        $stream = ssh2_exec($connection, $command);
        if (!$stream) {
            die('Error al ejecutar el comando SSH');
        }

        echo "Comando enviado para limitar el tráfico en wlan0.";
    } else {
        echo "No se encontraron datos de la antena para el cliente.";
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    echo "No se proporcionó el número de cliente.";
}
?>
