const createButton = document.getElementById('create-sprint');

createButton.onclick = function(event) {
    removeValidationErrors();

    try
    {
        let sprint = getFormData();
        sendRequest(JSON.stringify(sprint));
    }
    catch (error)
    {
        return false;
    }
}

function getFormData() {
    const urlParams = new URLSearchParams(location.search);
    const project_id = urlParams.get('project_id');
    const name = document.getElementById('name').value;
    const start_date = document.getElementById('start-date').value;
    const end_date = document.getElementById('end-date').value;
    const goal = document.getElementById('goal').value;

    const isNameValid = validateName(name);
    const isStartDateValid = validateStartDate(start_date, end_date);
    const isEndDateValid = validateEndDate(start_date, end_date);
    const isGoalValid = validateGoal(goal);

    if(isNameValid && isStartDateValid && isEndDateValid && isGoalValid) {
        let sprint = {
            name: name,
            start_date: start_date,
            end_date: end_date,
            goal: goal,
            project_id: project_id
        };

        return sprint;
    } else {
        throw new Error();
    }
}

var sendRequest = function(sprint) {
    let request = new XMLHttpRequest();
    request.open("POST", `../controllers/AddSprint.php`, true);
    request.setRequestHeader('Content-type', 'application/json');

    request.onload = function(e) {
        let response = request.response;
        let sprintObject = JSON.parse(sprint);
        const parsedResponse =  JSON.parse(response);

        if(typeof(parsedResponse) === 'number') {            
            window.location.replace('../controllers/GetProject.php?project_id=' + sprintObject.project_id);               
        } else {
            window.location.replace(`../views/Error.php?message=${parsedResponse.message}&status_code=${parsedResponse.status_code}`);
        }
    }

    request.send(sprint);
}