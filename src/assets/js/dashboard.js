const showTasksButtons = document.getElementsByClassName('show-sprint-tasks');

for (let button of showTasksButtons) {
    button.onclick = function (event) {
        const tasksElement = event.target.parentNode.parentNode.nextSibling;
        if (tasksElement.hidden) {
            tasksElement.hidden = false;
        } else {
            tasksElement.hidden = true;
        }
        
    }
}