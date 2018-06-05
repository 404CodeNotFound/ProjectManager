const createButton = document.getElementById('create-sprint');

createButton.onclick = function(event) {
    const sprint = getFormData();
    sendRequest(JSON.stringify(sprint));
}

function getFormData() {
    var urlParams = new URLSearchParams(location.search);
    var project_id = urlParams.get('project_id');

    let sprint = {
        name: document.getElementById('name').value,
        start_date: document.getElementById('start-date').value,
        end_date: document.getElementById('end-date').value,
        goal: document.getElementById('goal').value,
        project_id: project_id
    };

    return sprint;
}

var sendRequest = function(sprint) {
    let request = new XMLHttpRequest();
    request.open("POST", `../controllers/AddSprint.php`, true);
    request.setRequestHeader('Content-type', 'application/json');

    request.onload = function(e) {
        let response = request.response;
        let sprintObject = JSON.parse(sprint);

        if(response) {
            window.location.replace('http://localhost:8080/ProjectManager/src/controllers/GetProject.php?project_id=' + sprintObject.project_id);
        }
    }

    request.send(sprint);
}