document.addEventListener("DOMContentLoaded", function() {
    fetchCommunityList();
});

function fetchCommunityList() {
    fetch("get_communities.php")
    .then(response => response.json())
    .then(data => {
        displayCommunityList(data);
    })
    .catch(error => console.error('Error:', error));
}

function displayCommunityList(communities) {
    const communityListContainer = document.getElementById("communityList");

    if (communities.length === 0) {
        communityListContainer.innerHTML = "<p>No hay comunidades registradas.</p>";
        return;
    }

    communityListContainer.innerHTML = "<h2>Comunidades:</h2>";

    communities.forEach(community => {
        const communityElement = document.createElement("div");
        communityElement.classList.add("community");
        communityElement.textContent = community.localidad;
        communityListContainer.appendChild(communityElement);
    });
}
