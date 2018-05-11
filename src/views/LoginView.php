<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ProjectManager - Login</title>
</head>

<body>
    <form method="post" action="../controllers/Login.php">
        <fieldset>
            <legend>
                <h3>Login</h3>
            </legend>
            <div class="container">
                <label for="username"> Username </label>
                <input id="username" name="username" type="text" required />
                <div class="error">
                    <?php if(isset($_GET['username']) && $_GET['username']):?>
                        Username is required.
                    <?php endif?>
                </div>
            </div>
            <div class="container">
                <label for="password"> Password </label>
                <input id="password" name="password" type="password" required />
                <div class="error">
                    <?php if(isset($_GET['password']) && $_GET['password']):?>
                        Password is required.
                    <?php endif?>
                </div>
            </div>
            <div>
                <input type="submit" value="Login" />
            </div>
        </fieldset>
    </form>
</body>
</html>