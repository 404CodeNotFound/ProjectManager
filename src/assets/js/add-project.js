const submitBtn = document.getElementById('create-project');
const validationErrors = [];

submitBtn.onclick = function(event) {
    removeValidationErrors();
    let project;

    try {
        project = getAllDataFromForm();
    } catch (error) {
        return false;
    }

    sendForm(JSON.stringify(project));
}

function getAllDataFromForm() {
    const title = document.getElementById('title').value;
    const start_date = document.getElementById('start-date').value;
    const end_date = document.getElementById('end-date').value;
    const overview = document.getElementById('overview').value;

    const isTitleValid = validateTitle(title);
    const isStartDateValid = validateStartDate(start_date, end_date);
    const isEndDateValid = validateEndDate(start_date, end_date);
    const isOverviewValid = validateOverview(overview);

    if(isTitleValid && isStartDateValid && isEndDateValid && isOverviewValid) {
        let project = {
            participants: selectedUsers,
            title: title,
            start_date: start_date,
            end_date: end_date,
            overview: overview
        };

        return project;
    } else {
        throw new Error();
    }     
}

function sendForm(project) {
    let request = new XMLHttpRequest();
    request.open("POST", `../controllers/AddProject.php`, true);
    request.setRequestHeader('Content-type', 'application/json');

    request.onload = function(e) {
        let response = request.response;
        const parsedResponse =  JSON.parse(response);

        if(typeof(parsedResponse) === 'number') {            
            window.location.replace('../controllers/GetAllProjects.php');               
        } else {
            window.location.replace(`../views/Error.php?message=${parsedResponse.message}&status_code=${parsedResponse.status_code}`);
        }
    }

    request.send(project);
}
