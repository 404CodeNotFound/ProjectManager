<!DOCTYPE HTML>
<html>
    <head>
        <title>ProjectManager - Edit Task</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="../assets/css/main.css" />
    </head>
    <body>
        <div id="wrapper">
            <div id="main">
                <div class="inner">
                    <header id="header">
                        <h1 class="logo">Edit Task</h1>
                        <ul class="icons">
                            <li><a href="../controllers/Logout.php" class="icon fa-sign-out">Logout</a></li>
                        </ul>
                    </header>
                    <section id="banner">
                        <div class="content">
                            <form method="POST" action=<?php echo "./EditTask.php?id=".$task_id ?> id="edit-form">
                                <div class="row uniform">
                                        <div class="12u 12u$(xsmall)">
                                            <input type="text" name="title" id="title" placeholder="Task title" value="<?=$task->getTitle()?>" />
                                            <div class="error" id="title-row"></div>
                                        </div>
                                        <div class="6u 12u$(xsmall)">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description" placeholder="Enter task description..." rows="6"><?=$task->getDescription()?></textarea>
                                            <div class="error" id="description-row"></div>
                                        </div>
                                        <div class="6u 12u$(xsmall)">
                                            <label for="priority">Priority</label>
                                            <select name="priority" id="priority">
                                                <option value="Lowest" <?php if($task->getPriority() === "Lowest") { echo 'selected="selected"'; } ?> >Lowest</option>
                                                <option value="Low" <?php if($task->getPriority() === "Low") { echo 'selected="selected"'; } ?> >Low</option>
                                                <option value="Medium" <?php if($task->getPriority() === "Medium") { echo 'selected="selected"'; } ?> >Medium</option>
                                                <option value="High" <?php if($task->getPriority() === "High") { echo 'selected="selected"'; } ?> >High</option>
                                                <option value="Highest" <?php if($task->getPriority() === "Highest") { echo 'selected="selected"'; } ?> >Highest</option>
                                            </select>
                                        </div>
                                        <div class="6u 12u$(xsmall)">
                                            <label for="story-points">Story points</label>
                                            <input type="number" name="story-points" id="story-points" value="<?=$task->getStoryPoints()?>" />
                                            <div class="error" id="story-points-row"></div>
                                        </div>
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
                                <li><a href="../controllers/GetHomePage.php">Homepage</a></li>
                                <li><a href="../controllers/GetDashboard.php">Dashboard</a></li>                                                                
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
            <script src="../assets/js/task-validation.js"></script>
            <script src="../assets/js/edit-task.js"></script>
    </body>
</html>
