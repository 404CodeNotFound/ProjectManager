const editAssigneeButton = document.getElementById('edit-assignee');
let currentParticipants = new Set();

editAssigneeButton.onclick = function (event) {
    let infoElement = document.getElementById('assignee-info');
    infoElement.hidden = true;

    const addAssigneeDiv = document.createElement('div');
    addAssigneeDiv.id = 'add-assignee';

    const inputField = document.createElement('input');
    inputField.type = "text";
    inputField.placeholder = "Search users to assign this task";
    inputField.id = "assignee";
    addAssigneeDiv.appendChild(inputField);

    const closeButton = document.createElement('button');
    closeButton.id = 'edit-assignee-close';
    closeButton.innerHTML = '<i class="icon fa-close"></i>';

    closeButton.onclick = function (event) {
        addAssigneeDiv.parentNode.removeChild(addAssigneeDiv);
        infoElement.hidden = false;
    }

    addAssigneeDiv.appendChild(closeButton);

    const participantsResult = document.createElement('div');
    participantsResult.id = "participants-result";
    addAssigneeDiv.appendChild(participantsResult);

    const assigneeSpan = document.getElementById('assignee-param');
    assigneeSpan.parentNode.insertBefore(addAssigneeDiv, assigneeSpan.nextSibling);

    searchParticipants();
}

function searchParticipants() {
    const assigneeInput = document.getElementById('assignee');
    const project_id = document.getElementById('project-id').value;
    
    assigneeInput.addEventListener('keyup', function(event) {
        let participantsResult = document.getElementById('participants-result');
        participantsResult.innerText = '';
        currentParticipants.clear();
        const inputText = event.target.value;

        if (inputText.trim()) {
            let request = new XMLHttpRequest();
            request.open("GET", `../controllers/GetParticipants.php?project_id=${project_id}&pattern=${inputText}`);

            request.onload = function(e) {
                let response = request.response;
                let participants = JSON.parse(response);

                participants.forEach(participant => {
                    if(!currentParticipants.has(participant.id)) {
                        currentParticipants.add(participant.id);
                        addParticipantSuggestion(participant);                        
                    }
                });
            };

            request.send();
        }
    });
}

function addParticipantSuggestion(participant) {
    const participantsResult = document.getElementById('participants-result');

    let listItem = document.createElement('li');
    listItem.id = participant.id;
    listItem.classList.add('participant');
    listItem.innerHTML = participant.username;

    listItem.onclick = function(event) {
        console.log(listItem.id);
        
        const inputField = document.getElementById('assignee');
        inputField.value = participant.username;

        // Set assignee
        participantsResult.hidden = true;
        
        setAssignee(participant.id);
    }

    participantsResult.appendChild(listItem);
}

function setAssignee(participant_id) {
    const urlParams = new URLSearchParams(location.search);
    const task_id = urlParams.get('id');

    let request = new XMLHttpRequest();
    request.open("POST", `../controllers/AddAssignee.php?task_id=${task_id}`, true);
    request.setRequestHeader('Content-type', 'application/json');

    request.onload = function(e) {
        let response = JSON.parse(request.response);

        if(typeof(response) === 'number') {
            location.reload();
        } else {
            window.location.replace(`http://localhost/ProjectManager/src/views/Error.php?message=${response.message}&status_code=${response.status_code}`);
        }
        
    }

    request.send(participant_id);
}