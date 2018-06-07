function validateTitle(title) {
    if(!title.trim()) {
        addValidationError("title-row", "Title is required.");

        return false;
    }

    return true;
}

function validateDescription(description) {
    if(!description.trim()) {
        addValidationError("description-row", "Description is required.");

        return false;
    }

    return true;
}

function validateStoryPoints(storyPoints) {
    if(storyPoints < 0 || storyPoints > 100) {
        addValidationError("story-points-row", "Story points must be between 0 and 100.");

        return false;
    }

    return true;
}