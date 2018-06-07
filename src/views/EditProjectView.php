<!DOCTYPE HTML>
<html>
    <head>
        <title>ProjectManager - Edit Project</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="../assets/css/main.css" />
    </head>
    <body>
        <div id="wrapper">
            <div id="main">
                <div class="inner">
                    <header id="header">
                        <h1 class="logo">Edit Project</h1>
                        <ul class="icons">
                            <li><a href="../controllers/Logout.php" class="icon fa-sign-out">Logout</a></li>
                        </ul>
                    </header>
                    <section id="banner">
                        <div class="content">
                            <form method="POST" action=<?php echo "./EditProject.php?id=".$project_id ?> id="edit-form">
                                <div class="row uniform">
                                        <div class="12u 12u$(xsmall)">
                                            <input type="text" name="title" id="title" placeholder="Title" 
                                            value="<?=$project->getTitle()?>" required />
                                            <div class="error" id="title-row">
                                                <?php if(isset($_GET['title']) && $_GET['title'] === 'false'):?>
                                                    Project title is required.
                                                <?php endif?>
                                            </div>
                                        </div>
                                        <div class="6u 12u$(xsmall)">
                                            <label for="start-date" class="calendar-label">From</label>
                                            <input type="date" name="start_date" id="start-date" value=<?=$project->getStartDate()->format('Y-m-d')?> required />
                                            <div class="error" id="start-date-row">
                                                <?php if(isset($_GET['start_date']) && $_GET['start_date'] === 'false'):?>
                                                    Start date is required and could not be in the past.
                                                <?php endif?>
                                            </div>
                                        </div>
                                        <div class="6u 12u$(xsmall)">
                                            <label for="end-date" class="calendar-label">To</label>
                                            <input type="date" name="end_date" id="end-date" value=<?=$project->getEndDate()->format('Y-m-d')?> required />
                                            <div class="error" id="end-date-row">
                                                <?php if(isset($_GET['end_date']) && $_GET['end_date'] === 'false'):?>
                                                    End date is required and could not be before start date.
                                                <?php endif?>
                                            </div>
                                        </div>
                                        <div class="12u$">
                                            <textarea name="overview" id="overview" placeholder="Enter project overview..." rows="6"><?=$project->getOverview()?></textarea>
                                            <div class="error" id="overview-row">
                                                <?php if(isset($_GET['overview']) && $_GET['overview'] === 'false'):?>
                                                    Overview is required.
                                                <?php endif?>
                                            </div>
                                        </div>
                                        <div class="12u 12u$(xsmall)" id="selected-users"></div>
                                        <div class="12u$">
                                            <ul class="actions">
                                                <li><input type="submit" value="Edit" class="special"/></li>
                                            </ul>
                                        </div>
                                    </div>
                                </form>    
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
                                <li><a href="../views/HomePageLoggedView.php">Homepage</a></li>
                                <li><a href="generic.html">Dashboard</a></li>
                                <li><a href="../controllers/GetAllProjects.php">Projects</a></li>
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
            <script src="../assets/js/validation-helpers.js"></script>            
            <script src="../assets/js/project-validation.js"></script>
            <script src="../assets/js/edit-project.js"></script>
    </body>
</html>
