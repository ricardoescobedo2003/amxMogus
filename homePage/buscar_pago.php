<?php
$servername = "localhost";
$username = "dni";
$password = "MinuzaFea265/";
$dbname = "doblenet";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener los parámetros de búsqueda desde la solicitud AJAX
$no_cliente = $_GET['no_cliente'];

// Construir la consulta basada en los parámetros recibidos
$query = "SELECT * FROM pagos WHERE no_cliente = '$no_cliente' ORDER BY fecha DESC"; // Ordenar por fecha descendente

// Ejecutar la consulta
$result = $conn->query($query);

// Verificar la ejecución exitosa de la consulta
if ($result !== false) {
    // Comenzar la tabla HTML con estilos CSS
    echo '<style>
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                padding: 10px;
                border: 1px solid #000;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }
            tr:nth-child(even) {
                background-color: #f2f2f2;
            }
          </style>';
    echo '<table>';
    echo '<tr><th colspan="3" style="background-color: #ccc; font-size: 20px; text-align: center;">Historial de Cliente</th></tr>';
    echo '<tr><th style="width: 60%;">NOMBRE</th><th style="width: 20%;">FECHA</th><th style="width: 20%;">MONTO</th></tr>';

    // Mostrar resultados en la tabla
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row["nombre"] . '</td>';
            echo '<td>' . $row["fecha"] . '</td>';
            echo '<td>' . $row["monto"] . '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="3" style="text-align: center;">No se encontraron resultados.</td></tr>';
    }

    // Cerrar la tabla HTML
    echo '</table>';

} else {
    echo "Error en la consulta SQL: " . $conn->error;
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
