<!DOCTYPE HTML>
<html>
	<head>
		<title>Project Manager - Task Details</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="../assets/css/main.css" />
		<link rel="stylesheet" href="../assets/css/font-awesome.css" />        
	</head>
	<body>
        <div id="wrapper">
            <div id="alert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                <span id="alert-content"></span>
            </div>
            <div id="main">
                <div class="inner">
                    <header id="header">
                        <h2>Sprint Details</h2>
                        <ul class="icons">
                            <li><a href="../controllers/Logout.php" class="icon fa-sign-out">Logout</a></li>
                        </ul>
                    </header>
                    <section class="banner">
                        <div class="content" id="task-details">
                            <header>
                                <h4> <a href='./GetProject.php?project_id=<?php echo $task->getProject(); ?>' ><?=$project_title?></a> / <a href='./GetSprint.php?id=<?php echo $task->getSprint(); ?>' ><?=$task->getSprintName()?></a> </h4>
                                <h1><?=$task->getTitle()?></h1>
                            </header>
                            <p>
                                <?php
                                if($task->getAssignedTo())
                                {
                                    echo '<span class="param"> Asignee: </span> <span class="info"><?=$task->getAssignedTo()?>
                                            <button id="edit-assignee"><i class="icon fa-pencil"></i></button>
                                          </span>';
                                }
                                else
                                {
                                    echo '<span class="param"> <i class="icon fa-user"></i> Asignee: </span> <span class="info">Unknown 
                                            <button id="edit-assignee"><i class="icon fa-pencil"></i></button>
                                          </span>';
                                }
                                ?>
                            </p>
                            <p>
                                <span class="param"> <i class="icon fa-flag"></i> Priority:</span> <span class="info"><?=$task->getPriority()?> </span>
                            </p>
                            <p>
                                <span class="param">Status:</span> <span class="info"><?=$task->getStatus()?>
                                    <button id="edit-status"><i class="icon fa-pencil"></i></button>
                                </span>
                            </p>
                            <p>
                                <span class="param">Story points:</span> <span class="info"><?=$task->getStoryPoints()?></span>
                            </p>
                            <p>
                                <span class="param">Sprint:</span> <span class="info"><a href='./GetSprint.php?id=<?php echo $task->getSprint(); ?>' ><?=$task->getSprintName()?></a></span>
                            </p>                            
                            <p>
                                <span class="param">Descriprion:</span>
                                <p><?=$task->getDescription()?></p>
                            </p>
                        </div>
                        <div id="task-buttons">
                            <?php 
                                if($isPojectParticipant)
                                {
                                    echo '<a href="./DeleteTask.php?id='.$task_id.'" class="button default">Delete</a>';
                                    echo '<a href="./GetEditTask.php?id='.$task_id.'" class="button special">Edit</a>';
                                }
                            ?>
                        </div>
                    </section>
                </div>
            </div>
            <div id="sidebar">
                <div class="inner">
                        <section id="search" class="alt">
                            <h2>Project Manager</h2>
                        </section>

                        <nav id="menu">
                            <header class="major">
                                <h2>Menu</h2>
                            </header>
                            <ul>
                                <li><a href="./HomePageLoggedView.php">Homepage</a></li>
                                <li><a href="generic.html">Dashboard</a></li>
                                <li><a href="./GetAllProjects.php">Projects</a></li>
                                <li>
                                    <span class="opener" id="subnav-opener">Sprints</span>
                                    <ul>
                                        <?php
                                        foreach($user_active_sprints as $sprint)
                                        {
                                            echo '<li><a href="./GetSprint.php?id='.$sprint->getId().'">'.$sprint->getName().' ('.$sprint->getProjectTitle().')</a></li>';                                  
                                        }
                                        ?>
                                    </ul>
                                </li>
                            </ul>
                        </nav>

                        <footer id="footer">
                            <p class="copyright">&copy; Project Manager. All rights reserved.</p>
                        </footer>
                </div>
                <a class="toggle" href="#sidebar" id="navigation-toggler">Toggle</a>        
            </div>
        </div>

        <script src="../assets/js/navigation.js"></script>
        <script src="../assets/js/show-alerts.js"></script>
	</body>
</html>