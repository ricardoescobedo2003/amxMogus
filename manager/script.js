window.addEventListener('load', function() {
    fetchUsers();
});

function fetchUsers() {
    fetch('get_users.php')
    .then(response => response.json())
    .then(data => {
        const userList = document.getElementById('userList');
        userList.innerHTML = '';
        data.forEach(user => {
            const listItem = document.createElement('li');
            listItem.textContent = `ID: ${user.id_usuario}, Username: ${user.username}, Password: ${user.password}`;
            userList.appendChild(listItem);
        });
    })
    .catch(error => console.error('Error:', error));
}
