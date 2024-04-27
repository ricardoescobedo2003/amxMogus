function buscarCliente() {
    var no_cliente = document.getElementById("no_cliente").value;

    // Realizar la solicitud a PHP para buscar el cliente
    fetch("buscar_cliente.php", {
        method: "POST",
        body: new URLSearchParams({ no_cliente: no_cliente }),
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById("nombre_cliente").textContent = data.nombre;
            document.getElementById("ip_cliente").textContent = data.ip;
            document.getElementById("clienteInfo").style.display = "block";
        } else {
            document.getElementById("mensaje").textContent = data.message;
            document.getElementById("clienteInfo").style.display = "none";
        }
    })
    .catch(error => console.error("Error:", error));
}

function reiniciarCliente() {
    var ip_cliente = document.getElementById("ip_cliente").textContent;
    var usuario = prompt("Ingrese el usuario de la antena Ej ubnt:");
    var password = prompt("Ingrese la contraseña de su antena Ej ubnt:");

    // Realizar la solicitud a PHP para reiniciar el cliente
    fetch("reiniciar_cliente.php", {
        method: "POST",
        body: new URLSearchParams({ ip_cliente: ip_cliente, usuario: usuario, password: password }),
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        }
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message); // Mostrar mensaje de respuesta
    })
    .catch(error => console.error("Error:", error));
}

function limitarTrafico() {
    var ip_cliente = document.getElementById("ip_cliente").textContent;
    var usuario = prompt("Ingrese el usuario de la antena (Ejemplo: ubnt):");
    var password = prompt("Ingrese la contraseña de la antena:");

    // Realizar la solicitud a PHP para limitar el tráfico en la antena
    fetch("traffic.php", {
        method: "POST",
        body: new URLSearchParams({ ip_cliente: ip_cliente, usuario: usuario, password: password }),
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        }
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message); // Mostrar mensaje de respuesta
    })
    .catch(error => console.error("Error:", error));
}

function desbloquearCliente() {
    // Lógica para desbloquear al cliente
}

function verEstadisticas() {
    // Lógica para ver estadísticas del cliente
}
