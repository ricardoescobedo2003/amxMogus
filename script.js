function login() {
    // Obtener los valores de usuario y contraseña ingresados por el usuario
    var usernameInput = document.getElementById('username').value;
    var passwordInput = document.getElementById('password').value;

    // Verificar las credenciales
    if (usernameInput === 'ricardo.escobedo' && passwordInput === '21060212') {
        window.location.href="/admin/index.html"
    } 
    if (usernameInput == 'usuario@doblenet' && passwordInput == 'doblenetsystem'){
        window.location.href="/admin/index.html"
    }else {
        // Credenciales inválidas, mostrar un mensaje de error
        alert('Credenciales incorrectas. Inténtalo de nuevo.');
    }
}