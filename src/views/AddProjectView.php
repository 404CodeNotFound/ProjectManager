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
                <label for="course-title"> Project name </label>
                <input id="course-title" name="title" type="text" required>
                <div class="error">
                    <?php if(isset($_GET['title']) && $_GET['title']):?>
                        Името на дисциплината е задължително.
                    <?php endif?>
                </div>
            </div>
            <div class="container">
                <label for="course-lecturer"> Start date </label>
                <input id="course-lecturer" name="start_date" type="date" required>
                <div class="error">
                    <?php if(isset($_GET['lecturer']) && $_GET['lecturer']):?>
                        Името на лектора е задължително.
                    <?php endif?>
                </div>
            </div>
            <div class="container">
                <label for="course-end-date"> End date </label>
                <input id="course-end-date" name="end_date" type="date" required>
                <div class="error">
                    <?php if(isset($_GET['lecturer']) && $_GET['lecturer']):?>
                        Името на лектора е задължително.
                    <?php endif?>
                </div>
            </div>
            <div class="container">
                <label for="course-description"> Project overview </label>
                <textarea id="course-description" name="overview" required></textarea>
                <?php if(isset($_GET['description']) && $_GET['description']):?>
                    Описанието на дисциплината е задължително.
                <?php endif?>
            </div>
            <div>
                <input type="reset" value="Изчисти" />
                <input type="submit" value="Добави" />
            </div>
        </fieldset>
    </form>
</body>
</html>