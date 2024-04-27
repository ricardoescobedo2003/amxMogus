// Selecciona el formulario por su id
document.getElementById("searchForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Evitar el envío del formulario por defecto
    
    var formData = new FormData(this);
    
    fetch(this.action, {
        method: this.method,
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        // Oculta el formulario después de recibir la respuesta
        document.getElementById("searchForm").style.display = "none";
        
        // Muestra el resultado dentro del elemento con id "resultado"
        document.getElementById("resultado").innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
});
