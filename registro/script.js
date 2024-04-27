window.onload = function() {
    // Obtener todos los campos de entrada del formulario
    var formInputs = document.querySelectorAll('#clienteForm input, #clienteForm select, #clienteForm textarea');

    // Agregar evento keypress a cada campo de entrada
    formInputs.forEach(function(input) {
        input.addEventListener('keypress', function(e) {
            // Verificar si la tecla presionada es Enter (código 13)
            if (e.keyCode === 13) {
                // Obtener el índice del campo actual en el arreglo
                var currentIndex = Array.from(formInputs).indexOf(input);
                // Enfocar el siguiente campo de entrada si existe
                if (formInputs[currentIndex + 1]) {
                    formInputs[currentIndex + 1].focus();
                    e.preventDefault(); // Evitar que se envíe el formulario al presionar Enter
                }
            }
        });
    });

    // Cargar los paquetes al cargar la página
    cargarPaquetes();

    // Actualizar la mensualidad al cambiar el paquete seleccionado
    document.getElementById("paquete").addEventListener("change", function() {
        actualizarMensualidad();
    });
};

function actualizarMensualidad() {
    console.log("Se actualiza la mensualidad"); // Agregar esta línea para verificar
    var precioPaquete = parseFloat(document.getElementById("paquete").value);
    var mensualidadInput = document.getElementById("mensualidad");
    mensualidadInput.value = isNaN(precioPaquete) ? '' : precioPaquete.toFixed(2);
}


function cargarPaquetes() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var paquetes = JSON.parse(this.responseText);
            var selectPaquete = document.getElementById("paquete");
            // Limpiamos las opciones anteriores en caso de recarga de la página
            selectPaquete.innerHTML = "";
            paquetes.forEach(function(paquete) {
                var option = document.createElement("option");
                option.text = paquete.paquete;
                option.value = paquete.precio;
                selectPaquete.appendChild(option);
            });
            // Al cargar los paquetes, actualizamos la mensualidad inicial
            actualizarMensualidad();
        }
    };
    xmlhttp.open("GET", "get_paquetes.php", true);
    xmlhttp.send();
}

window.onload = function() {
    // Funciones y código relacionado con la carga de la página
}

function guardarCliente() {
    // Obtener datos del formulario
    var idc = document.getElementById('idc').value;
    var nombre = document.getElementById('nombre').value;
    var direccion = document.getElementById('direccion').value;
    var telefono = document.getElementById('telefono').value;
    var localidad = document.getElementById('localidad').value;
    var fechaInstalacion = document.getElementById('fechaInstalacion').value;
    var equipos = document.getElementById('equipos').value;
    var paquete = document.getElementById('paquete').value;
    var mensualidad = document.getElementById('mensualidad').value;
    var comentarios = document.getElementById('comentarios').value;
    var ip = document.getElementById('ip').value;

    // Enviar datos a través de AJAX a PHP
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("mensaje").innerHTML = this.responseText;
            // Limpiar el formulario después de guardar el cliente
            limpiarFormulario();
        }
    };
    xmlhttp.open("POST", "guardar_cliente.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("idc=" + idc + "&nombre=" + nombre + "&direccion=" + direccion + "&telefono=" + telefono + "&localidad=" + localidad + "&fechaInstalacion=" + fechaInstalacion + "&equipos=" + equipos + '&paquete=' + paquete + '&mensualidad=' + mensualidad + "&comentarios=" + comentarios + "&ip=" + ip);
}

function limpiarFormulario() {
    // Limpiar los valores de los campos del formulario
    document.getElementById('idc').value = '';
    document.getElementById('nombre').value = '';
    document.getElementById('direccion').value = '';
    document.getElementById('telefono').value = '';
    document.getElementById('localidad').value = '';
    document.getElementById('fechaInstalacion').value = '';
    document.getElementById('equipos').value = '';
    document.getElementById('paquete').value = '';
    document.getElementById('mensualidad').value = '';
    document.getElementById('comentarios').value = '';
    document.getElementById('ip').value = '';
}

function redireccionar() {
    // Redireccionar a otra página después de guardar el cliente
    window.location.href = "/consulta/index.html";
}

function searchUsuario() {
    // Redireccionar a otra página para buscar y editar clientes
    window.location.href = "/busquedaEdicion/index.html";
}
