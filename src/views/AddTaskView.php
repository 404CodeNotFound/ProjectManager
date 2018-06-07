<!DOCTYPE HTML>
<html>
    <head>
        <title>ProjectManager - Create Task</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="../assets/css/main.css" />
    </head>
    <body>
            <div id="wrapper">
                <div id="main">
                    <div class="inner">
                            <header id="header">
                                <h1 class="logo">Create Task</h1>
                                <ul class="icons">
                                    <li><a href="../controllers/Logout.php" class="icon fa-sign-out">Logout</a></li>
                                </ul>
                            </header>

                            <section id="banner">
                                <div class="content">
                                        <div class="row uniform">
                                            <div class="12u 12u$(xsmall)">
                                                <input type="text" name="title" id="title" placeholder="Task title" required />
                                                <div class="error" id="title-row"></div>
                                            </div>
                                            <div class="12u$">
                                                <label for="description">Description</label>
                                                <textarea name="description" id="description" placeholder="Enter task description..." rows="6"></textarea>
                                                <div class="error" id="description-row"></div>
                                            </div>
                                            <div class="6u 12u$(xsmall)">
                                                <label for="priority">Priority</label>
                                                <select name="priority" id="priority">
                                                    <option value="Lowest">Lowest</option>
                                                    <option value="Low">Low</option>
                                                    <option value="Medium">Medium</option>
                                                    <option value="High">High</option>
                                                    <option value="Highest">Highest</option>
                                                </select>
                                                <div class="error" id="priority-row"></div>
                                            </div>
                                            <div class="6u 12u$(xsmall)">
                                                <label for="story-points">Story points</label>
                                                <input type="number" name="story-points" id="story-points" value="0" required />
                                                <div class="error" id="story-points-row"></div>
                                            </div>

                                            <div class="12u$">
                                                <ul class="actions">
                                                    <li><input type="submit" value="Create" class="special" id="create-task"/></li>
                                                </ul>
                                            </div>
                                        </div>
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
                                <li><a href="../controllers/GetAllProjects.php">Projects</a></li>
                                <li>
                                    <span class="opener">Sprints</span>
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
                </div>

            </div>

            <script src="../assets/js/jquery.min.js"></script>
            <script src="../assets/js/skel.min.js"></script>
            <script src="../assets/js/util.js"></script>
            <script src="../assets/js/main.js"></script>
            <script src="../assets/js/validation-helpers.js"></script>            
            <script src="../assets/js/task-validation.js"></script>            
            <script src="../assets/js/add-task.js"></script>
    </body>
</html>
