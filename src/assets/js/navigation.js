const navToggler = document.getElementById('navigation-toggler');
const sidebar = document.getElementById('sidebar');

navToggler.onclick = function(event) {
    event.preventDefault();
    event.stopPropagation();
    sidebar.classList.toggle('inactive');
}