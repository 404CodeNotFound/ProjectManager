<!DOCTYPE HTML>
<html>
	<head>
		<title>Project Manager - Dashboard</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="../assets/css/main.css" />    
	</head>
	<body>
        <div id="wrapper">
            <div id="main">
                <div class="inner">
                    <header id="header">
                        <h2>Dashboard</h2>
                        <ul class="icons">
                            <li><a href="../controllers/Logout.php" class="icon fa-sign-out">Logout</a></li>
                        </ul>
                    </header>
                    <section class="banner">      
                        <div class="content">
                            <?php
                                foreach ($user_active_sprints as $sprint)
                                {
                                    echo '<div class="active-sprint">';
                                    echo '<div class="sprint-header row">';
                                    echo '<span class="sprint-header-name">'.$sprint->getName().'</span>';
                                    echo ' <span class="sprint-header-project">('.$sprint->getProjectTitle().')</span>';
                                    echo '<div class="show-sprint-tasks">...</div>';                                    
                                    echo '</div>';
                                    echo '<div class="sprint-tasks" hidden=true>';
                                        $sprint_tasks = $sprint->getTasks();
                                        if($sprint_tasks) 
                                        {
                                            foreach ($sprint_tasks as $task)
                                            {
                                                echo '<div class="dashboard-task">';
                                                echo '<a href="./GetTask.php?id='.$task->getId().'"><i class="icon fa-list"></i> '.$task->getTitle().'</a>';
                                                echo '<span class="dashboard-task-status '.str_replace(" ", "-", $task->getStatus()).'">'.$task->getStatus().'</span>';
                                                echo '</div>';
                                            }
                                        }
                                        else
                                        {
                                            echo '<div>No tasks in this sprint yet.</div>';
                                        }
                                        
                                    echo '</div>';
                                    echo '</div>';
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
                            <li><a href="../controllers/GetHomePage.php">Homepage</a></li>
                            <li><a href="../controllers/GetDashboard.php">Dashboard</a></li>
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
        <script src="../assets/js/dashboard.js"></script>
	</body>
</html>