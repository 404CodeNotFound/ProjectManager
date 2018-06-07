const form = document.getElementById('edit-form');

form.onsubmit = function() {
    removeValidationErrors();
    
	const title = document.getElementById('title').value;
    const description = document.getElementById('description').value;
    const storyPoints = document.getElementById('story-points').value;

    const isTitleValid = validateTitle(title);
    const isDescriptionValid = validateDescription(description);
    const areStoryPointsValid = validateStoryPoints(storyPoints);

    if(isTitleValid && isDescriptionValid && areStoryPointsValid) {
        return true;
    } else {
        return false;
    }     
}
