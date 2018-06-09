<!DOCTYPE HTML>
<html>
	<head>
		<title>Project Manager - Home</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/main.css" />
	</head>
	<body>
		<div id="wrapper">
			<div id="main">
				<div class="inner">
					<header id="header">
						<h2>Home</h2>
						<ul class="icons">
							<li><a href="../controllers/Logout.php" class="icon fa-sign-out">Logout</a></li>
						</ul>
					</header>
					<section class="banner">
						<div class="content">
							<header>
								<h1>Welcome to<br />
								Project Manager!</h1>
								<p>Manage all your agile projects</p>
							</header>
							<p>With Project Manager you can successfully manage all your projects in an agile way and handle all deadlines. Create projects, add sprints and tasks. Track the status of completeness of all your tasks.</p>
						</div>
						<span class="image object">
							<img width="400px"src="https://cdn-images-1.medium.com/max/2000/1*u4EBes6Muu2fy7iM8igMug.jpeg" alt="" />
						</span>
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
                                        if(count($user_active_sprints) <= 0)
                                        {
                                            echo '<li>You have no active sprints.</li>';
                                        }
                                        else 
                                        {
                                            foreach($user_active_sprints as $sprint)
                                            {
                                                echo '<li><a href="./GetSprint.php?id='.$sprint->getId().'">'.$sprint->getName().' ('.$sprint->getProjectTitle().')</a></li>';                                  
                                            }
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