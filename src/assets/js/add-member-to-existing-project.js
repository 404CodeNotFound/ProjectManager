const addMemberBtn = document.getElementById('add-member-btn');
let isSearchOpened = false;

addMemberBtn.onclick = function (event) {
    if(!isSearchOpened) {
        isSearchOpened = true;
        this.innerText = 'Close search';
        showSearchForm();
    } else {
        isSearchOpened = false;
        this.innerText = 'Add member';
        hideSearchForm();
    }
}   

function hideSearchForm() {
    const newMemberDiv = document.getElementById('new-member');
    const userResultsDiv = document.getElementById('user-results');
    const searchForm = document.getElementById('participant');
    newMemberDiv.removeChild(userResultsDiv);
    newMemberDiv.removeChild(searchForm);
}

function showSearchForm() {
    const searchForm = document.createElement('input');
    const resultsDiv = document.createElement('div');
    resultsDiv.id = 'user-results';
    searchForm.type = 'text';
    searchForm.placeholder = 'Search users by username...';
    searchForm.id = 'participant';
    const div = document.getElementById('new-member');
    div.appendChild(searchForm);
    div.appendChild(resultsDiv);

    searchUsers();
}
            
function addSearchResultToDom(user, contextNode) {
    let input = document.createElement('input');
    input.value = user.username;
    input.id = user.id;
    input.type = 'checkbox';
    const index = selectedUsers.findIndex(u => u.username === user.username);
    if(index >= 0) {
        input.checked = true;
    }

    input.addEventListener('change', function() {
        if(this.checked) {
            postMember(this.value, this);
        } else {
            deleteMember(user.username);
        }
    });

    let label = document.createElement('label');
    label.htmlFor = user.id;
    label.innerText = user.username;

    let div = document.createElement('div');

    div.appendChild(input);
    div.appendChild(label);

    contextNode.appendChild(div);
}

function addSelectedUserToDom(username, full_name) {
    let li = document.createElement('li');
    let a = document.createElement('a');
    a.href = `./GetUserProfile.php?id=${username}`;
    a.id = username;
    a.innerText = full_name;
    li.appendChild(a);
    let ul = document.getElementById('participants-list');
    ul.appendChild(li);
}

function removeSelectedUserFromDom(username) {
    let a = document.getElementById(username);
    a.parentNode.remove();
}

function postMember(username, checkbox) {
    const projectId = window.location.href.split('=')[1];
    let request = new XMLHttpRequest();
    request.open("POST", `../controllers/AddMember.php?project_id=${projectId}`, true);
    request.setRequestHeader('Content-type', 'application/json');

    request.onload = function(e) {
        let response = JSON.parse(request.response);
        if(!response.hasOwnProperty('message')) {
            addSelectedUserToDom(username, response);
        } else {
            checkbox.checked = false;
            showErrorAlert(response.message);
        }
    }

    request.send(username);
}

function deleteMember(username) {
    const projectId = window.location.href.split('=')[1];
    let request = new XMLHttpRequest();
    request.open("POST", `../controllers/RemoveMember.php?project_id=${projectId}`, true);
    request.setRequestHeader('Content-type', 'application/json');

    request.onload = function(e) {
        let response = request.response;
        if(!response.hasOwnProperty('message')) {
            removeSelectedUserFromDom(username);
        } else {
            showErrorAlert(response.message);
        }
    }

    request.send(username);
}