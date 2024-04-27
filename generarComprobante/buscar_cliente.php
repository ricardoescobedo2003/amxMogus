<?php
$servername = "localhost";
$username = "dni";
$password = "MinuzaFea265/";
$dbname = "doblenet";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$no_cliente = $_POST['clientes'];

$sql = "SELECT * FROM clientes WHERE no_cliente = '$no_cliente'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $cliente_nombre = $row['nombre'];
    $direccion = $row['direccion'];
    $telefono = $row['telefono'];

    // Recuperar la información del último pago del cliente desde la tabla pagos
    $sql_pago = "SELECT fecha, monto FROM pagos WHERE no_cliente = '$no_cliente' ORDER BY fecha DESC LIMIT 1";
    $result_pago = $conn->query($sql_pago);
    
    if ($result_pago->num_rows > 0) {
        $row_pago = $result_pago->fetch_assoc();
        $fecha_pago = $row_pago['fecha'];
        $monto_pago = $row_pago['monto'];
    } else {
        $fecha_pago = "No hay pagos registrados";
        $monto_pago = "N/A";
    }
} else {
    $cliente_nombre = "Cliente no encontrado";
    $direccion = "No disponible";
    $telefono = "No disponible";
    $fecha_pago = "No hay pagos registrados";
    $monto_pago = "N/A";
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wisp Manager Web</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">
        </div>

    </header>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th colspan="2">Información del Pago</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                    <td>No Cliente: </td>
                    <td><?php echo $no_cliente; ?></td>
                </tr>
                <tr>
                    <td>Nombre del Cliente:</td>
                    <td><?php echo $cliente_nombre; ?></td>
                </tr>
                <tr>
                    <td>Fecha del Último Pago:</td>
                    <td><?php echo $fecha_pago; ?></td>
                </tr>
                <tr>
                    <td>Monto del Último Pago:</td>
                    <td><?php echo $monto_pago; ?></td>
                </tr>
            </tbody>
        </table>
        <div class="info">
            <p><strong>Información adicional:</strong></p>
            <hr>
                <p><strong>Fecha de Emisión:</strong> <?php echo date("d/m/Y"); ?></p>
                <p><strong>Fecha de Vencimiento: 25 días después de emisión</strong></p>
                <hr>

                <hr>
                <h4>Método de Pago:</h4>
                <p>Por favor, realiza el pago utilizando uno de los siguientes métodos:</p>
                <ul>
                    <li>Transferencia bancaria a la cuenta 4217-4700-0129-8922</li>
                    <li>Transferencia bancaria tipo STP 646930146401986182</li>
                    <li>Pago en efectivo con algún administrador</li>
                    <!-- Agrega más métodos de pago según sea necesario -->
                </ul>
                <hr>
                <h4>Información de Contacto:</h4>
                <p>Si tienes alguna pregunta o necesitas asistencia, no dudes en contactarnos:</p>
                <ul>
                    <li>Teléfono: 498-144-22-66</li>
                    <li>Email: ricardoescobedo@ricardosync.tech</li>
                    <!-- Agrega más detalles de contacto según sea necesario -->
                </ul>
            <hr>
            <p><strong>Términos y Condiciones:</strong>
            Este documento sirve únicamente como comprobante de pago y no constituye una factura oficial.</p>
            <p>&copy; <?php echo date("Y"); ?> Software por Escobedo & DobleNet.</p>
        </div>
    </div>
</body>
</html>
