function validateName(name) {
    if(!name.trim()) {
        addValidationError("name-row", "Name is required.");

        return false;
    }

    return true;
}

function validateStartDate(startDate, endDate) {
    const start = new Date(startDate);
    const end = new Date(endDate);
    const current= new Date();

    if(!startDate || start > end || start < current) {
        addValidationError("start-date-row", "Start date is invalid.");

        return false;
    }

    return true;
}

function validateStartDateOnEdit(startDate, endDate) {
    const start = new Date(startDate);
    start.setHours(0,0,0,0);

    const end = new Date(endDate);
    end.setHours(0,0,0,0);
    
    if(!startDate.trim() || start > end) {
        addValidationError("start-date-row", "Start date is invalid.");
        return false;
    }

    return true;
}

function validateEndDate(startDate, endDate) {
    const start = new Date(startDate);
    start.setHours(0,0,0,0);

    const end = new Date(endDate);
    end.setHours(0,0,0,0);

    const current= new Date();
    current.setHours(0,0,0,0);

    if(!endDate || start > end || end < current) {
        addValidationError("end-date-row", "End date is invalid.");
        return false;
    }

    return true;
}

function validateGoal(goal) {
    if(!goal.trim()) {
        addValidationError("goal-row", "Goal is required.");

        return false;
    }

    return true;
}