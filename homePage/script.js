function buscarPago() {
    // Obtener los datos del formulario de búsqueda
    var no_cliente = document.getElementById("no_cliente").value;

    // Realizar una petición AJAX para buscar el pago en la base de datos
    fetch('buscar_pago.php?no_cliente=' + encodeURIComponent(no_cliente))
    .then(response => response.text())
    .then(data => {
        // Mostrar los resultados en el div 'resultado'
        document.getElementById("resultado").innerHTML = data;
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
