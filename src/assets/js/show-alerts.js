function showErrorAlert(message) {
    let alertContent = document.getElementById('alert-content');
    alertContent.innerText = message;
    let alert = document.getElementById('alert');
    alert.style.display = 'block';
    alert.style.background = 'red';
}