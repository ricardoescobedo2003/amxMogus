document.addEventListener("DOMContentLoaded", function() {
    cargarDatosPagos();

    document.getElementById("formRecaudacion").addEventListener("submit", function(event) {
        event.preventDefault();
        calcularRecaudacion();
    });
});

function cargarDatosPagos() {
    fetch('get_pagos.php')
        .then(response => response.json())
        .then(data => {
            const tbodyPagos = document.getElementById('tbodyPagos');
            tbodyPagos.innerHTML = ''; // Limpiar datos anteriores

            data.forEach(pago => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${pago.id_pago}</td>
                    <td>${pago.no_cliente}</td>
                    <td>${pago.nombre}</td>
                    <td>${pago.fecha}</td>
                    <td>${pago.monto}</td>
                    <td>${pago.no_recibo}</td>
                `;
                tbodyPagos.appendChild(row);
            });
        });
}

function calcularRecaudacion() {
    const fechaInicio = document.getElementById('fechaInicio').value;
    const fechaFin = document.getElementById('fechaFin').value;

    fetch('calcular_recaudacion.php', {
        method: 'POST',
        body: new URLSearchParams({
            fechaInicio: fechaInicio,
            fechaFin: fechaFin
        })
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('recaudacionResult').innerText = data;
    });
}
