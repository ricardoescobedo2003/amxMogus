<?php
// Obtener los datos enviados por el formulario
$data = json_decode(file_get_contents('php://input'), true);

// Verificar que se hayan recibido los datos requeridos
if (isset($data['no_cliente'], $data['no_recibo'])) {
  $no_cliente = $data['no_cliente'];
  $no_recibo = $data['no_recibo'];

  // Conexión a la base de datos (modifica las credenciales según tu configuración)
  $servername = "localhost";
  $username = "dni";
  $password = "MinuzaFea265/";
  $dbname = "doblenet";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
  }

  // Consulta para obtener la mensualidad del cliente
  $sql = "SELECT nombre, mensualidad FROM clientes WHERE no_cliente = $no_cliente";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombre = $row['nombre'];
    $mensualidad = $row['mensualidad'];

    // Insertar el pago en la tabla de pagos
    $fecha_actual = date('Y-m-d');
    $insert_sql = "INSERT INTO pagos (no_cliente, nombre, fecha, monto, no_recibo) VALUES ($no_cliente, '$nombre', '$fecha_actual', $mensualidad, '$no_recibo')";

    if ($conn->query($insert_sql) === TRUE) {
      // Envío de mensaje por WhatsApp
      $phone = "5214961121843"; // Número de teléfono al que se enviará el mensaje
      $message = urlencode("El cliente: $nombre realizó su pago con éxito el día $fecha_actual por la cantidad de: $mensualidad con NO Recibo: $no_recibo.");
      $apikey = "4387760"; // Tu API Key de CallMeBot
      $url = "https://api.callmebot.com/whatsapp.php?phone=$phone&text=$message&apikey=$apikey";

      $response = file_get_contents($url);

      if ($response === false) {
          echo json_encode(['message' => 'Error al enviar el mensaje por WhatsApp.']);
      } else {
          echo json_encode(['message' => 'Pago registrado con éxito y mensaje enviado por WhatsApp.']);
      }
    } else {
      echo json_encode(['message' => 'Error al registrar el pago: ' . $conn->error]);
    }
  } else {
    echo json_encode(['message' => 'No se encontró al cliente con ese número']);
  }

  $conn->close();
} else {
  echo json_encode(['message' => 'Falta información para procesar la solicitud']);
}
?>
