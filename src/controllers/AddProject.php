<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use helpers\Validator;
use models\Project;

$title = $_POST['title'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$overview = $_POST['overview'];


$is_title_valid = Validator::exists($title);
$is_start_date_valid = Validator::exists($start_date) && Validator::isValidStartDate($start_date);
$is_end_date_valid = Validator::exists($end_date) && Validator::isValidEndDate($end_date, $start_date);
$is_overview_valid = Validator::exists($overview);

if (!$is_title_valid || !$is_start_date_valid || !$is_end_date_valid || !$is_overview_valid) {
    header('Location: ../views/AddProjectView.php?title=' . json_encode($is_title_valid) . '&start_date=' . json_encode($is_start_date_valid) . '&end_date=' . json_encode($is_end_date_valid));
} else {
    $project = Project::create($title, $start_date, $end_date, $overview, 1);
    $isSuccessful = $project->insert();

    if ($isSuccessful) {
        header('Location: ../views/ProjectDetailsView.php');
    } else {
        echo "<p> Error! The subject was not inserted! </p>";
    }
}
?> 