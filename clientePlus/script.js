document.getElementById("searchForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Evitar el envío del formulario por defecto

    var formData = new FormData(this);

    fetch("buscar_cliente.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById("clienteInfo").innerHTML = data;
        document.getElementById("reciboForm").style.display = "block";
        document.getElementById("clienteNoHidden").value = document.getElementById("clienteNo").value;
    })
    .catch(error => console.error('Error:', error));
});

document.getElementById("pagoForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Evitar el envío del formulario por defecto

    var formData = new FormData(this);

    fetch("registrar_pago.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data); // Muestra la respuesta del servidor en un cuadro de alerta
    })
    .catch(error => console.error('Error:', error));
});
