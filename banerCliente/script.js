document.addEventListener('DOMContentLoaded', function() {
    const menuBtn = document.querySelector('.menu-btn');
    const menuItems = document.querySelector('.menu-items');
  
    menuBtn.addEventListener('click', function() {
      menuItems.style.display = (menuItems.style.display === 'block') ? 'none' : 'block';
    });
  
    // Hide menu if user clicks outside of it
    document.addEventListener('click', function(event) {
      if (!menuBtn.contains(event.target) && !menuItems.contains(event.target)) {
        menuItems.style.display = 'none';
      }
    });
  });
  