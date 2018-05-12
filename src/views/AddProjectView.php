<!DOCTYPE HTML>
<html>
    <head>
        <title>ProjectManager - Create Project</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="../assets/css/main.css" />
    </head>
    <body>
            <div id="wrapper">
                    <div id="main">
                        <div class="inner">
                                <header id="header">
                                    <h1 class="logo">Create Project</h1>
                                </header>

                                <section id="banner">
                                    <div class="content">
                                        <form method="post" action="../controllers/AddProject.php">
                                            <div class="row uniform">
                                                <div class="12u 12u$(xsmall)">
                                                    <input type="text" name="title" id="title" placeholder="Title" required />
                                                    <div class="error">
                                                        <?php if(isset($_GET['title']) && $_GET['title']):?>
                                                            Project title is required.
                                                        <?php endif?>
                                                    </div>
                                                </div>
                                                <div class="6u 12u$(xsmall)">
                                                    <label for="start-date" class="calendar-label">From</label>
                                                    <input type="date" name="start_date" id="start-date" required />
                                                    <div class="error">
                                                        <?php if(isset($_GET['start_date']) && $_GET['start_date']):?>
                                                            Start date is required and could not be in the past.
                                                        <?php endif?>
                                                    </div>
                                                </div>
                                                <div class="6u 12u$(xsmall)">
                                                    <label for="end-date" class="calendar-label">To</label>
                                                    <input type="date" name="end_date" id="end-date" required />
                                                    <div class="error">
                                                        <?php if(isset($_GET['end_date']) && $_GET['end_date']):?>
                                                            End date is required and could not be before start date.
                                                        <?php endif?>
                                                    </div>
                                                </div>
                                                <div class="12u$">
                                                    <textarea name="overview" id="overview" placeholder="Enter project overview..." rows="6"></textarea>
                                                    <div class="error">
                                                        <?php if(isset($_GET['overview']) && $_GET['overview']):?>
                                                            Overview is required.
                                                        <?php endif?>
                                                    </div>
                                                </div>
                                                <div class="12u 12u$(xsmall)">
                                                    <input type="text" name="participants" id="participants" placeholder="Enter participants..." />
                                                </div>
                                                <!-- Break -->
                                                <div class="12u$">
                                                    <ul class="actions">
                                                        <li><input type="submit" value="Create" class="special" /></li>
                                                        <li><input type="reset" value="Reset" /></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <span class="image object">
                                        <img src="images/pic10.jpg" alt="" />
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
                                        <li><a href="./HomepageView.php">Homepage</a></li>
                                        <li><a href="generic.html">Dashboard</a></li>
                                        <li><a href="./ProjectsList.php">Projects</a></li>
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
            <script>
                let autocompleteDiv = document.createElement('div');
                autocompleteDiv.setAttribute("id", "autocomplete-list");

                const users = [ {id: 1, username: "yoana"}, {id: 2, username: "yo"}];
                const participantsInput = document.getElementById('participants');

                participantsInput.addEventListener("keydown", function (event) {
                    clearSuggestions();
                    const inputValue = event.target.value;                        
                        this.parentNode.appendChild(autocompleteDiv);
                        const pattern = inputValue.trim();
                        if(pattern) {
                            const matches = users.filter(user => contains(pattern, user.username))
                            .map(user => user.username);

                            for(let i = 0; i < matches.length; i++) {
                                let row = document.createElement('p');
                                row.innerText = matches[i];
                                autocompleteDiv.appendChild(row);
                            }
                        }
                    
                });

                function clearSuggestions() {
                    console.log('here');
                    autocompleteDiv.innerText = '';
                }

                function contains(pattern, str) {
                    return str.substr(0, pattern.length) === pattern;
                }
            </script> 
    </body>
</html>
