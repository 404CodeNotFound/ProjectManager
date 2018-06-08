<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use helpers\Validator;
use models\Project;
use models\ProjectParticipant;
use models\Error;

session_start();
if(!isset($_SESSION['current_user_id']))
{
    $error = new Error("Only authorized users can create new project.", 401);
    echo json_encode($error);
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
    
    $is_title_valid = Validator::exists($title);
    $is_start_date_valid = Validator::exists($start_date);
    $is_end_date_valid = Validator::exists($end_date);
    $is_overview_valid = Validator::exists($overview);
    
    if(!($is_title_valid && $is_start_date_valid && $is_end_date_valid && $is_overview_valid)) 
    {
        header('Location: ./controllers/GetAddProjectPage.php?title=' . json_encode($is_title_valid) . '&start_date=' . json_encode($is_start_date_valid) . '&end_date=' . json_encode($is_end_date_valid) . '&overview=' . json_encode($is_overview_valid));
    }
    else 
    {
        foreach ($data['participants'] as $participant) {
            foreach ($participant as $key => $value) {
                if($key === 'id' && $value != $current_user) 
                {
                    $participants[] = $value;
                }
            }
        }
    
        $project = Project::create($title, $start_date, $end_date, $overview, $current_user);
    
        try {
            $isSuccessful = $project->insert();
            $project_id = Project::getProjectIdByTitle($title);
    
            foreach ($participants as $participant_id) {
                $link = ProjectParticipant::create($project_id, $participant_id);
                $isSuccessful = $link->insert();
            }
    
            echo $isSuccessful;
            
        } catch (Exception $ex) {
            $error = new Error("Server error.", 500);
            echo json_encode($error);
        }
    }
}
?> 