<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use models\Project;

$projects = Project::getAll();

require_once('../views/ProjectsListView.php');
?>