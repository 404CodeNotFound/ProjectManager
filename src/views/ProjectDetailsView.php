<!DOCTYPE HTML>
<html>
	<head>
		<title>Project Manager - Project Details</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="../assets/css/main.css" />
		<link rel="stylesheet" href="../assets/css/font-awesome.css" />        
	</head>
	<body>
        <div id="wrapper">
            <div id="main">
                <div class="inner">
                    <header id="header">
                        <h2>Project Details</h2>
                    </header>
                    <section class="banner">
                        <div class="content" id="project-details">
                            <header>
                                <h1><?=$project->getTitle()?></h1>
                                <p><span class="info"><?=$remains->format('%D%')?></span> days more.</p>
                            </header>
                            <p><span class="param"><i class="icon fa-calendar"></i> Start:</span> <span class="info"><?=$project->getStartDate()->format('d/m/Y')?></span></p>
                            <p><span class="param"><i class="icon fa-calendar"></i> End:</span> <span class="info"><?=$project->getEndDate()->format('d/m/Y')?></span></p>
                            <p><span class="param"><i class="icon fa-user"></i> Project Owner:</span> <span class="info"><?=$project->getOwnerName()?></span></p>                            
                            <p><?=$project->getOverview()?></p>
                            <h4><i class="icon fa-users"></i> Participants:</h4>
                            <ul id="participants-list">
                                <?php
                                foreach($participants as $user)
                                {
                                    echo '<li><a href="./GetUserProfile.php?id='.$user->getUsername().'">'.$user->getFullName().'</a></li>';                                    
                                }
                                ?>
                            </ul>
                            <div id="new-member">
                                <button class="button special" id="add-member-btn">Add member</button>
                            </div>
                        </div>
                        <div class="6u">
                        <?php 
                            if($project->getIsActive())
                            {
                                echo '<span class="button default disabled">Active</span>';
                            }
                            ?>
                            <a href=<?php echo "./GetEditProject.php?id=".$project_id ?> class="button special">Edit</a>
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
                                <li><a href="./HomepageView.php">Homepage</a></li>
                                <li><a href="generic.html">Dashboard</a></li>
                                <li><a href="./GetAllProjects.php">Projects</a></li>
                                <li>
                                    <span class="opener">Sprints</span>
                                    <ul>
                                        <li><a href="#">Active Sprint</a></li>
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
        <script src="../assets/js/search.users.js"></script>
        <script src="../assets/js/add.member.js"></script>
	</body>
</html>