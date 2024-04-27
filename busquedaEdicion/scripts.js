document.addEventListener("DOMContentLoaded", function() {
    // Obtener las comunidades y agregarlas al select de la página
    fetch('get_localidades.php')
    .then(response => response.json())
    .then(data => {
        const comunidadSelect = document.getElementById('comunidad');
        data.forEach(comunidad => {
            const option = document.createElement('option');
            option.value = comunidad;
            option.textContent = comunidad;
            comunidadSelect.appendChild(option);
        });
    });
});

function buscarUsuario() {
    const nombre = document.getElementById("nombre").value;

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "search.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        if (xhr.status === 200) {
            document.getElementById("resultContainer").innerHTML = xhr.responseText;
        }
    };

    xhr.send("nombre=" + nombre);
}

function busquedaComunidad() {
    const comunidad = document.getElementById("comunidad").value;

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "searchLocalidad.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        if (xhr.status === 200) {
            document.getElementById("resultContainer").innerHTML = xhr.responseText;
        }
    };

    xhr.send("comunidad=" + comunidad);
}

function eliminarUsuario(id_cliente) {
    const confirmacion = confirm("¿Estás seguro de que deseas eliminar este usuario?");
    
    if (confirmacion) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "delete.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onload = function () {
            if (xhr.status === 200) {
                alert(xhr.responseText);
                // Puedes recargar la página o realizar otras acciones después de la eliminación
            }
        };

        xhr.send("id_cliente=" + id_cliente);
    }
}

function editarUsuario(id_cliente) {
    window.location.href = "edit.php?id_cliente=" + id_cliente; // Corregido a id_cliente
}
