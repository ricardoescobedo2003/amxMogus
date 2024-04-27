document.addEventListener("DOMContentLoaded", function() {
    // Fetch clientes from database and populate select dropdown
    fetch('get_clients.php')
    .then(response => response.json())
    .then(data => {
        const clientesSelect = document.getElementById('clientes');
        data.forEach(cliente => {
            const option = document.createElement('option');
            option.value = cliente.no_cliente;
            option.textContent = cliente.nombre;
            clientesSelect.appendChild(option);
        });
    });
});
