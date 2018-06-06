function addValidationError(elementId, message) {
    const parentElement = document.getElementById(elementId);
    const errorElement = document.createElement('div');
    errorElement.innerText = message;
    errorElement.class = "error";

    parentElement.appendChild(errorElement);
}

function removeValidationErrors() {
    const errorElements = document.getElementsByClassName('error');

    for(let i = 0; i < errorElements.length; i++) {
        errorElements[i].innerText = '';
    }
}