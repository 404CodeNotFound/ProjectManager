const editStatusButton = document.getElementById('edit-status');
const STATUSES = {
    TO_DO: 'To-do',
    IN_PROGRESS: 'In progress',
    DONE: 'Done',
};

editStatusButton.onclick = function(event) {
    let infoElement = document.getElementById('status-info');
    const currentStatus = infoElement.firstChild.innerText;
    infoElement.hidden = true;

    const editStatusDiv = document.createElement('div');
    editStatusDiv.id = 'update-status';

    const selectElement = document.createElement('select');
    selectElement.id = 'status-select';
    for (let status in STATUSES) {
        let optionElement = document.createElement('option');
        optionElement.value = STATUSES[status];
        optionElement.innerText = STATUSES[status];

        if (STATUSES[status] === currentStatus) {
            let selectedAttribute = document.createAttribute('selected');
            selectedAttribute.value = 'selected';
            optionElement.setAttributeNode(selectedAttribute);
        }

        selectElement.appendChild(optionElement);
    }

    selectElement.addEventListener("change", function (event) {
        editStatus(event.target.value.trim());
    });

    editStatusDiv.appendChild(selectElement);

    const closeButton = document.createElement('button');
    closeButton.id = 'edit-status-close';
    closeButton.innerHTML = '<i class="icon fa-close"></i>';

    closeButton.onclick = function (event) {
        editStatusDiv.parentNode.removeChild(editStatusDiv);
        infoElement.hidden = false;
    }
    editStatusDiv.appendChild(closeButton);
    
    const statusSpan = document.getElementById('status-param');
    statusSpan.parentNode.insertBefore(editStatusDiv, statusSpan.nextSibling);
}

function editStatus(status) {
    const urlParams = new URLSearchParams(location.search);
    const task_id = urlParams.get('id');

    let request = new XMLHttpRequest();
    request.open("POST", `../controllers/EditStatus.php?task_id=${task_id}`, true);
    request.setRequestHeader('Content-type', 'application/json');

    request.onload = function(e) {
        let response = JSON.parse(request.response);

        if(typeof(response) === 'number') {
            location.reload();
        } else {
            window.location.replace(`../views/Error.php?message=${response.message}&status_code=${response.status_code}`);
        }
        
    }

    request.send(status);
}