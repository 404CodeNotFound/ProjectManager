searchUsers();
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
            selectedUsers.push({username: this.value, id: this.id });
            addSelectedUserToDom(this.value);
        } else {
            const userIndex = selectedUsers.find(u => u.username === user.username);
            selectedUsers.splice(index, 1);
            removeSelectedUserFromDom(user.username);
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

function addSelectedUserToDom(username) {
    let li = document.createElement('li');
    li.innerText = username;
    li.id = username;
    let ul = document.getElementById('selected-users');
    ul.appendChild(li);
}

function removeSelectedUserFromDom(username) {
    let li = document.getElementById(username);
    li.remove();
}