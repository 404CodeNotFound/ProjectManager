<!DOCTYPE HTML>
<html>
    <head>
        <title>ProjectManager - Register</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="../assets/css/main.css" />
    </head>
    <body>
        <div id="wrapper">
            <div id="main">
                <div class="inner">
                    <header id="header">
                        <h1 class="logo" id="register-title">Register</h1>
                    </header>
                    <section id="register-banner" class="banner">
                        <form method="post" action="../controllers/Register.php">
                            <div class="row uniform" id="register-inputs">
                                <div class="8u 12u$(xsmall)">
                                    <input type="text" name="username" id="username" placeholder="Username" required />
                                    <div class="error">
                                        <?php if(isset($_GET['username']) && $_GET['username'] === 'false'):?>
                                            Username is required.
                                        <?php endif?>
                                    </div>
                                </div>
                                <div class="8u 12u$(xsmall)">
                                    <input type="password" name="password" id="password" placeholder="Password" />
                                    <div class="error">
                                        <?php if(isset($_GET['password']) && $_GET['password'] === 'false'):?>
                                            Password is required.
                                        <?php endif?>
                                    </div>
                                </div>

                                <div class="8u 12u$(xsmall)">
                                    <input type="password" name="repeated_password" id="repeated-password" placeholder="Repeat Password" />
                                    <div class="error">
                                        <?php if(isset($_GET['repeated_password']) && $_GET['repeated_password'] === 'false'):?>
                                            Passwords does not match.
                                        <?php endif?>
                                    </div>
                                </div>

                                <div class="8u 12u$(xsmall)">
                                    <input type="email" name="email" id="email" placeholder="Email" />
                                    <div class="error">
                                        <?php if(isset($_GET['email']) && $_GET['email'] === 'false'):?>
                                            Email is required and should be valid.
                                        <?php endif?>
                                    </div>
                                </div>

                                <div class="8u 12u$(xsmall)">
                                    <input type="text" name="full_name" id="full-name" placeholder="Full Name" />
                                    <div class="error">
                                        <?php if(isset($_GET['full_name']) && $_GET['full_name'] === 'false'):?>
                                            Full name is required.
                                        <?php endif?>
                                    </div>
                                </div>
                                
                                <div class="8u 12u$">
                                    <ul id="login-actions" class="actions">
                                        <li><input type="submit" value="Register" class="special" /></li>
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
                            <li><a href="./LoginView.php">Login</a></li>
                            <li><a href="./RegisterView.php">Register</a></li>
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