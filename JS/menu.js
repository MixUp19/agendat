const menuToggle = document.querySelector('.menu-toggle');
const sidebar = document.querySelector('.sidebar');
const mainContent = document.querySelector('.main-content');

menuToggle.addEventListener('click', () => {
  sidebar.classList.toggle('active');
  mainContent.classList.toggle('active');
});
document.addEventListener('DOMContentLoaded', function() {
  var profilePicture = document.querySelector('.profile-picture');
  var profileDropdown = document.querySelector('.profile-dropdown');

  profilePicture.addEventListener('click', function(event) {
      event.stopPropagation();
      profileDropdown.style.display = profileDropdown.style.display === 'block' ? 'none' : 'block';
  });

  document.addEventListener('click', function(event) {
      if (!profilePicture.contains(event.target)) {
          profileDropdown.style.display = 'none';
      }
  });
});