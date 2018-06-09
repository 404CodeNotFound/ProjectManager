<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\User;
use models\Project;
use models\ProjectParticipant;
use models\Error;

session_start();
if(!isset($_SESSION['current_user_id'])) {
	http_send_status(401);
    $error = new Error("Only authorized users can add member to project.", 401);
	echo json_encode($error);
} else {
	$current_user = $_SESSION['current_user_id'];
	$project_id = $_GET['project_id'];
	$username = file_get_contents('php://input');

	$project = Project::getProjectById($project_id);
	if(!$project->getId()) {
		$error = new Error("Project was not found.", 404);
		echo json_encode($error);
	} else if($project->getOwner() !== $current_user) {
		$error = new Error("You cannot add new member to project because you are not the owner.", 403);
		echo json_encode($error);
	} else {
		$user = User::getUserByUsername($username);
		
		if(!$user->getId()) {
			$error = new Error("Selected user was not found.", 404);
			echo json_encode($error);
		} else {
			$existing_member = ProjectParticipant::findParticipantOfProject($user->getId(), $project_id);

			if($existing_member->getId()) {
				$error = new Error("Selected user is already added to project.", 409);
				echo json_encode($error);
			} else {
				$member = ProjectParticipant::create($project_id, $user->getId());

				try {
					$member->insert();
					echo json_encode($user->getFullName());
				} catch (Exceprion $ex) {
					$error = new Error("Could not add selected user to project.", 500);
					echo json_encode($error);
				}
			}
		}	
	}
}
?>