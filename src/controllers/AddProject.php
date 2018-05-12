<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use helpers\Validator;
use models\Project;
use models\ProjectParticipant;

session_start();
if(!isset($_SESSION['current_user_id']))
{
    http_response_code(401);
	header('Location: ../views/ErrorPage');
}
else
{
	$current_user = $_SESSION['current_user_id'];
	$json = file_get_contents('php://input');
    $data = json_decode($json, true);

	$title = $data['title'];
	$start_date = $data['start_date'];
	$end_date = $data['end_date'];
	$overview = $data['overview'];
	$participants = [$current_user];

	foreach ($data['participants'] as $participant) {
		foreach ($participant as $key => $value) {
			if($key === 'id') 
			{
				$participants[] = $value;
			}
		}
	}

    $project = Project::create($title, $start_date, $end_date, $overview, $current_user);
    $isSuccessful = $project->insert();

    if ($isSuccessful) {
    	$project_id = Project::getProjectIdByTitle($title);

    	foreach ($participants as $participant_id) {
    		$link = ProjectParticipant::create($project_id, $participant_id);
    		$isSuccessful = $link->insert();

    		if(!$isSuccessful)
    		{
    			echo "<p> Error! The project was not inserted! </p>";
    			break;
    		}
    	}

    	echo $isSuccessful;
    } else {
        echo "<p> Error! The project was not inserted! </p>";
    }
}
?> 