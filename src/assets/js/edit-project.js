const form = document.getElementById('edit-form');
form.onsubmit = function() {
	removeValidationErrors();
	const title = document.getElementById('title').value;
    const start_date = document.getElementById('start-date').value;
    const end_date = document.getElementById('end-date').value;
    const overview = document.getElementById('overview').value;

    const isTitleValid = validateTitle(title);
    const isStartDateValid = validateStartDate(start_date, end_date);
    const isEndDateValid = validateEndDate(start_date, end_date);
    const isOverviewValid = validateOverview(overview);

    if(isTitleValid && isStartDateValid && isEndDateValid && isOverviewValid) {
        return true;
    } else {
        return false;
    }     
}