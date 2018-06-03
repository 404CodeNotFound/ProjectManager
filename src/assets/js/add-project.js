const submitBtn = document.getElementById('create-project');

submitBtn.onclick = function(event) {
    const project = getAllDataFromForm();
    sendForm(JSON.stringify(project));
}

function getAllDataFromForm() {
    let project = {
        participants: selectedUsers,
        title: document.getElementById('title').value,
        start_date: document.getElementById('start-date').value,
        end_date: document.getElementById('end-date').value,
        overview: document.getElementById('overview').value
    };

    return project;
}

function sendForm(project) {
    let request = new XMLHttpRequest();
    request.open("POST", `../controllers/AddProject.php`, true);
    request.setRequestHeader('Content-type', 'application/json');

    request.onload = function(e) {
        let response = request.response;
        console.log(response);
        if(response) {
            window.location.replace('http://localhost/ProjectManager/src/controllers/GetAllProjects.php')
        }
    }

    request.send(project);
}