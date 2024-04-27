function confirmarPago() {
  const nombre = document.getElementById('nombre').value;
  const no_recibo = document.getElementById('no_recibo').value;

  // Validar que ambos campos estén completos
  if (!nombre || !no_recibo) {
    alert('Por favor completa todos los campos.');
    return;
  }

  // Enviar los datos al servidor
  fetch('procesar_pago.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ nombre, no_recibo }),
  })
  .then(response => response.json())
  .then(data => {
    // Mostrar resultado en el div 'resultado'
    document.getElementById('resultado').innerHTML = data.message;
  })
  .catch(error => {
    console.error('Error:', error);
    alert('Hubo un error al procesar la solicitud.');
  });
}
