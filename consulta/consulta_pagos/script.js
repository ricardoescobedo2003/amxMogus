function mostrarResultados(resultados) {
    var resultadosDiv = document.getElementById("resultados");

    if (resultados.length > 0) {
        // Crear tabla de resultados
        var tabla = "<table><tr><th>ID Pago</th><th>Nombre</th><th>Fecha</th><th>Monto</th><th>No Recibo</th></tr>";
        // Recorrer los resultados en orden inverso para mostrar primero los más recientes
        for (var i = 0; i < resultados.length; i++) {
            tabla += "<tr><td>" + resultados[i].no_cliente + "</td><td>" + resultados[i].nombre + "</td><td>" + resultados[i].fecha + "</td><td>" + resultados[i].monto + "</td>" + "<td>" + resultados[i].no_recibo + "</td></tr>"; // <--- Aquí se agregó </tr>
        }
        tabla += "</table>";
        resultadosDiv.innerHTML = tabla;
    } else {
        resultadosDiv.innerHTML = "<p>No se encontraron resultados</p>";
    }
}
