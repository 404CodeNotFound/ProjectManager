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
                    </header>
                    <section class="banner">
                        <div class="content">
                            <ul class="alt">
                                <?php 
                                    foreach($projects as $project) 
                                    {
                                        echo "<li><a href='./GetProject.php?project_id=".$project->getId()."'>".$project->getTitle()."</li>";
                                    }
                                ?>
                            </ul>
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
                                <li><a href="../views/HomepageView.php">Homepage</a></li>
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

	</body>
</html>