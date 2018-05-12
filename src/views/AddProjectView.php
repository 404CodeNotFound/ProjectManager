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
                                                <div class="12u 12u$(xsmall)" id="selected-users">

                                                </div>
                                                <div class="12u 12u$(xsmall)">
                                                    <input type="text" name="participant" id="participant" placeholder="Enter participant username..." />
                                                    <input type="button" name="search_user" id="search-user" value="Search">
                                                    <div id="user-results"></div>
                                                </div>

                                                <div class="12u$">
                                                    <ul class="actions">
                                                        <li><input type="submit" value="Create" class="special" id="create-project"/></li>
                                                        <li><input type="reset" value="Reset" /></li>
                                                    </ul>
                                                </div>
                                            </div>
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
                let selectedUsers = [];
                const searchUserBtn = document.getElementById('search-user');

                searchUserBtn.onclick = function(event) {
                    const searchUserInput = document.getElementById('participant');
                    let resultsDiv = document.getElementById('user-results');
                    resultsDiv.innerText = '';
                    let request = new XMLHttpRequest();
                    request.open("GET", `../controllers/GetUsers.php?username=${searchUserInput.value}`);

                    request.onload = function(e) {
                        let response = request.response;
                        let users = JSON.parse(response);

                        for(let i = 0; i < users.length; i++) {
                            addSearchResultToDom(users[i], resultsDiv);
                        }
                    }

                    request.send();
                }

                
                function addSearchResultToDom(user, contextNode) {
                    let input = document.createElement('input');
                    input.value = user.username;
                    input.id = user.id;
                    input.type = 'checkbox';
                    const index = selectedUsers.findIndex(u => u.username === user.username);
                    if(index >= 0) {
                        input.checked = true;
                    }

                    input.addEventListener('change', function() {
                        if(this.checked) {
                            console.log('check')
                            selectedUsers.push({username: this.value, id: this.id });
                        } else {
                            const userIndex = selectedUsers.find(u => u.username === user.username);
                            selectedUsers.splice(index, 1);
                        }
                    });

                    let label = document.createElement('label');
                    label.htmlFor = user.id;
                    label.innerText = user.username;

                    let div = document.createElement('div');

                    div.appendChild(input);
                    div.appendChild(label);

                    contextNode.appendChild(div);
                }

                const submitBtn = document.getElementById('create-project');
                submitBtn.onclick = function(event) {
                    const project = getAllDataFromForm();

                    sendForm(JSON.stringify(project));
                }

                function getAllDataFromForm() {
                    let project = {
                        participants: selectedUsers,
                        title: document.getElementById('title').value,
                        start_date: document.getElementById('start-date').value,
                        end_date: document.getElementById('end-date').value,
                        overview: document.getElementById('overview').value
                    };

                    return project;
                }

                function sendForm(project) {
                    let request = new XMLHttpRequest();
                    request.open("POST", `../controllers/AddProject.php`, true);
                    request.setRequestHeader('Content-type', 'application/json');

                    request.onload = function(e) {
                        let response = request.response;
                        console.log(response);
                    }

                    request.send(project);
                }
            </script> 
    </body>
</html>
