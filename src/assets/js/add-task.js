const createButton = document.getElementById('create-task');

createButton.onclick = function(event) {
    removeValidationErrors();

    try
    {
        let task = getFormData();

        sendRequest(JSON.stringify(task));
    }
    catch (error)
    {
        return false;
    }
}   

function getFormData() {
    const urlParams = new URLSearchParams(location.search);
    const sprint_id = urlParams.get('sprint_id');

    const title = document.getElementById('title').value;
    const description = document.getElementById('description').value;
    const prioritySelectElement = document.getElementById('priority');
    const priority = prioritySelectElement.options[prioritySelectElement.selectedIndex].value;
    const storyPoints = document.getElementById('story-points').value;

    const isTitleValid = validateTitle(title);
    const isDescriptionValid = validateDescription(description);
    const areStoryPointsValid = validateStoryPoints(storyPoints);

    if(isTitleValid && isDescriptionValid && areStoryPointsValid) {
        let task = {
            title: title,
            description: description,
            priority: priority,
            story_points: storyPoints,
            sprint_id: sprint_id
        };

        return task;
    } else {
        throw Error();
    }
}

var sendRequest = function(task) {
    let request = new XMLHttpRequest();
    request.open("POST", `../controllers/AddTask.php`, true);
    request.setRequestHeader('Content-type', 'application/json');

    request.onload = function(e) {
        let response = request.response;
        console.log(response);
        let taskObject = JSON.parse(task);
        const parsedResponse =  JSON.parse(response);

        if(typeof(parsedResponse) === 'number') {            
            window.location.replace('http://localhost/ProjectManager/src/controllers/GetSprint.php?id=' + taskObject.sprint_id);               
        } else {
            window.location.replace(`http://localhost/ProjectManager/src/views/Error.php?message=${parsedResponse.message}&status_code=${parsedResponse.status_code}`);
        }
    }

    request.send(task);
}