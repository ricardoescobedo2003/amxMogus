document.addEventListener("DOMContentLoaded", function() {
    // Escuchar el evento submit para el formulario de usuario
    document.getElementById("userForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Evitar el envío del formulario por defecto
        // Obtener datos del formulario
        var formData = new FormData(this);
        // Enviar datos mediante fetch
        fetch("process_user.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // Mostrar el mensaje de respuesta del servidor en el elemento con id "userMessage"
            document.getElementById("userMessage").innerHTML = data;
        })
        .catch(error => console.error('Error:', error));
    });

    // Escuchar el evento submit para el formulario de comunidad
    document.getElementById("communityForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Evitar el envío del formulario por defecto
        // Obtener datos del formulario
        var formData = new FormData(this);
        // Enviar datos mediante fetch
        fetch("process_community.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // Mostrar el mensaje de respuesta del servidor en el elemento con id "communityMessage"
            document.getElementById("communityMessage").innerHTML = data;
        })
        .catch(error => console.error('Error:', error));
    });

    // Escuchar el evento submit para el formulario de paquete
    document.getElementById("packageForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Evitar el envío del formulario por defecto
        // Obtener datos del formulario
        var formData = new FormData(this);
        // Enviar datos mediante fetch
        fetch("process_package.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // Mostrar el mensaje de respuesta del servidor en el elemento con id "packageMessage"
            document.getElementById("packageMessage").innerHTML = data;
        })
        .catch(error => console.error('Error:', error));
    });
});

document.addEventListener("DOMContentLoaded", function() {
    // Escuchar el evento submit para el formulario de usuario
    document.getElementById("userForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Evitar el envío del formulario por defecto
        // Obtener datos del formulario
        var formData = new FormData(this);
        // Enviar datos mediante fetch
        fetch("process_user.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // Mostrar el mensaje de respuesta del servidor en el elemento con id "userMessage"
            document.getElementById("userMessage").innerHTML = data;
        })
        .catch(error => console.error('Error:', error));
    });

    // Resto del código para otros formularios si es necesario
});

