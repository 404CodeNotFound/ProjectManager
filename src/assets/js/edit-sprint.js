const form = document.getElementById('edit-form');

form.onsubmit = function() {
    removeValidationErrors();
    
	const name = document.getElementById('name').value;
    const start_date = document.getElementById('start-date').value;
    const end_date = document.getElementById('end-date').value;
    const goal = document.getElementById('goal').value;

    const isNameValid = validateName(name);
    const isStartDateValid = validateStartDateOnEdit(start_date, end_date);
    const isEndDateValid = validateEndDate(start_date, end_date);
    const isGoalValid = validateGoal(goal);

    if(isNameValid && isStartDateValid && isEndDateValid && isGoalValid) {
        return true;
    } else {
        return false;
    }     
}
