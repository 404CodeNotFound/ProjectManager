const navToggler = document.getElementById('navigation-toggler');
const sidebar = document.getElementById('sidebar');
const opener = document.getElementById('subnav-opener');

navToggler.onclick = function(event) {
    event.preventDefault();
    event.stopPropagation();
    sidebar.classList.toggle('inactive');
}

opener.onclick = function(event) {
    event.preventDefault();
    this.classList.toggle('active');
}
