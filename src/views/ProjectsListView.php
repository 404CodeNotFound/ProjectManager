<!DOCTYPE HTML>
<html>
	<head>
		<title>Project Manager - Projects</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="../assets/css/main.css" />    
	</head>
	<body>
        <div id="wrapper">
            <div id="main">
                <div class="inner">
                    <header id="header">
                        <h2>All Projects</h2>
                        <ul class="icons">
                            <li><a href="../controllers/Logout.php" class="icon fa-sign-out">Logout</a></li>
                        </ul>
                    </header>
                    <section class="banner">      
                        <div class="content row">
                            
                            <ul class="alt 10u">
                                <?php 
                                    foreach($projects as $project) 
                                    {
                                        echo "<li><a href='./GetProject.php?project_id=".$project->getId()."'>".$project->getTitle()."</a></li>";
                                    }
                                ?>
                            </ul>
                            
                        </div>
                        <div class="2u">
                            <a class="button special" href="../controllers/GetAddProjectPage.php">Create project</a>
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
	</body>
</html>