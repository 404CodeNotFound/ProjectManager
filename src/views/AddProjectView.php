<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ProjectManager - Create Project</title>
</head>

<body>
    <form method="post" action="../controllers/AddProject.php">
        <fieldset>
            <legend>
                <h3>Create Project</h3>
            </legend>
            <div class="container">
                <label for="project-title"> Project name </label>
                <input id="project-title" name="title" type="text" required>
                <div class="error">
                    <?php if(isset($_GET['title']) && $_GET['title']):?>
                        Project title is required.
                    <?php endif?>
                </div>
            </div>
            <div class="container">
                <label for="project-start-date"> Start date </label>
                <input id="project-start-date" name="start_date" type="date" required>
                <div class="error">
                    <?php if(isset($_GET['start_date']) && $_GET['start_date']):?>
                        Start date is required and could not be in the past.
                    <?php endif?>
                </div>
            </div>
            <div class="container">
                <label for="project-end-date"> End date </label>
                <input id="project-end-date" name="end_date" type="date" required>
                <div class="error">
                    <?php if(isset($_GET['end_date']) && $_GET['end_date']):?>
                        End date is required and could not be before start date.
                    <?php endif?>
                </div>
            </div>
            <div class="container">
                <label for="project-overview"> Project overview </label>
                <textarea id="project-overview" name="overview" required></textarea>
                <?php if(isset($_GET['overview']) && $_GET['overview']):?>
                    Overview is required.
                <?php endif?>
            </div>
            <div>
                <input type="reset" value="Reset" />
                <input type="submit" value="Create" />
            </div>
        </fieldset>
    </form>
</body>
</html>