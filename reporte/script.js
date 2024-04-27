document.getElementById('reportForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita que el formulario se envíe automáticamente
  
    // Obtiene los datos del formulario
    var nombre = document.getElementById('nombre').value;
    var telefono = document.getElementById('telefono').value;
    var checkpoint = document.getElementById('checkpoint').value;
  
    // Construye el mensaje con los datos del formulario
    var message = "El cliente con Nombre: " + nombre + "\n y Teléfono: " + telefono + "\n reporto una falla: " + checkpoint;
  
    // Realiza una petición GET a un script PHP que obtiene la URL de la API de la base de datos
    fetch('get_api_url.php')
    .then(response => response.text())
    .then(apiUrl => {
      // Concatena el mensaje a la URL de la API
      var urlWithMessage = apiUrl + encodeURIComponent(message);
  
      // Realiza una redirección a la URL con el mensaje
      window.location.href = urlWithMessage;
    })
    .catch(error => {
      console.error('Error:', error);
      alert("Error al obtener la URL de la API. Por favor, inténtalo de nuevo más tarde.");
    });
  });
  