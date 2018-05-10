<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ProjectManager - Register</title>
</head>

<body>
    <form method="post" action="../controllers/Register.php">
        <fieldset>
            <legend>
                <h3>Register</h3>
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
            <div class="container">
                <label for="repeated-password"> Repeat Password </label>
                <input id="repeated-password" name="repeated_password" type="password" required />
                <div class="error">
                    <?php if(isset($_GET['repeated_password']) && $_GET['repeated_password']):?>
                        Passwords does not match.
                    <?php endif?>
                </div>
            </div>
            <div class="container">
                <label for="email"> Email </label>
                <input id="email" name="email" type="email" required />
                <?php if(isset($_GET['email']) && $_GET['email']):?>
                    Email is required and should be valid.
                <?php endif?>
            </div>
            <div class="container">
                <label for="full-name"> Full Name </label>
                <input id="full-name" name="full_name" type="text" required />
                <?php if(isset($_GET['full_name']) && $_GET['full_name']):?>
                    Full name is required.
                <?php endif?>
            </div>
            <div>
                <input type="submit" value="Register" />
            </div>
        </fieldset>
    </form>
</body>
</html>