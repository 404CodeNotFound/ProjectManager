<!DOCTYPE HTML>
<html>
    <head>
        <title>ProjectManager - Login</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="../assets/css/main.css" />
    </head>
    <body>
        <div id="wrapper">
            <div id="main">
                <div class="inner">
                    <header id="header">
                        <h1 class="logo" id="login-title">Login</h1>
                    </header>
                    <section id="login-banner" class="banner">
                        <form method="post" action="../controllers/Login.php">
                            <div class="row uniform" id="login-inputs">
                                <div class="8u 12u$(xsmall)">
                                    <input type="text" name="username" id="username" placeholder="Username" required />
                                    <div class="error">
                                        <?php if(isset($_GET['username']) && $_GET['username'] == 'false'):?>
                                            Username is required.
                                        <?php endif?>
                                        <?php if(isset($_GET['found']) && $_GET['found'] == 'false'):?>
                                            Incorrect username or password.
                                        <?php endif?>
                                    </div>
                                </div>
                                <div class="8u 12u$(xsmall)">
                                    <input type="password" name="password" id="password" placeholder="Password" />
                                    <div class="error">
                                        <?php if(isset($_GET['password']) && $_GET['password'] == 'false'):?>
                                            Password is required.
                                        <?php endif?>
                                    </div>
                                </div>
                                <div class="8u 12u$">
                                    <ul id="login-actions" class="actions">
                                        <li><input type="submit" value="Login" class="special" /></li>
                                        <li><input type="reset" value="Reset" /></li>
                                    </ul>
                                </div>
                            </div>
                        </form>
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
                            <li><a href="../controllers/GetLoginPage.php">Login</a></li>
                            <li><a href="../controllers/GetRegisterPage.php">Register</a></li>
                        </ul>
                    </nav>

                    <footer id="footer">
                        <p class="copyright">&copy; WWW 10th ed, Project Manager by S.Tsenova (61946) and Y.Georgieva (61920). All rights reserved.</p>
                    </footer>
                </div>
                <a class="toggle" href="#sidebar" id="navigation-toggler">Toggle</a>
            </div>
        </div>
        <script src="../assets/js/navigation.js"></script>
    </body>
</html>