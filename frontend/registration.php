<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Library Search</title>
        <link href="css/stylesheet.css" type="text/css" rel="stylesheet" />
        <link href="css/normalize.css" type="text/css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <script src="javascript/dynamics.js"></script>
        <meta charset="UTF-8">
    </head>
    <body>
        <div class="header">
            <h3 class="logo">Library Search</h3>
            <div class="nav">
                <ul class="nav-list">
                    <li id="search"><a href="search.php">Search</a></li>
                    <li id="add"><a href="submission.php">Add a Library</a></li>
                    <li id="about"><a href="search.php">About</a></li>
                    <li id="login"><a href="registration.php">Login</a></li>
                </ul>
            </div>
        </div>
        
        <div class="content">
            <div id="banner">
                <!-- The two following forms will appear on the left and right sides of the page. -->
                <div class="form vertical-form vertical-form-left">
                    <h1 class="main-header">Login</h1>
                    <form method="post" name="search" onsubmit="return validateLogin();">
                        <input type="email" id="login-email" placeholder="Email" name="login-email">
                        <p id="login-email-error"></p>
                        <input type="password" id="login-password" placeholder="Password" name="login-password">
                        <p id="login-password-error"></p>
                        <input type="submit" value="Login">
                    </form>
                </div>
                <div class="form vertical-form vertical-form-right">
                    <h1 class="main-header">Register</h1>
                    <form action="search.html" method="get" name="search" onsubmit="return validateRegistration();">
                        <input type="email" id="registration-email" placeholder="Email" name="registration-username"> 
                        <p id="registration-email-error"></p>
                        <input type="password" id="registration-password" placeholder="Password" name="registration-password">
                        <p id="registration-password-error"></p>
                        <input type="password" id="registration-password-confirm" placeholder="Confirm Password" name="registration-password-confirm">
                        <p id="registration-password-confirm-error"></p>
                        <input type="submit" value="Register">
                    </form>
                </div>
            </div>
        </div>
        <?php require 'php-inc/database.php';
        if (isset($_POST['login-email']) && isset($_POST['login-password'])) {
            try {
                $pdo = new PDO($connection,$username,$password);
                $stmt = $pdo->prepare('SELECT count(*) as count FROM `users` where `email`=:email and `password`=:password');
                $stmt->bindValue(':email', $_POST['login-email']);
                $stmt->bindValue(':password', $_POST['login-password']);
                $stmt->execute();  
                $errors = $stmt->errorInfo();
                
                foreach ($stmt as $row) {
                    if ($row["count"] == 1) {
                        echo "Login valid";
                    } else {
                        echo "Login invalid";
                    }
                }
            } catch (PDOException $e) {
                die ("Database error. ".$e);
            }
        }
        ?>
        <div class="footer">
            <hr/>
            <p>Copyright (c) 2016 Ryan Davis</p>
            <ul class="nav-list">
                <li id="about-footer"><a href="search.php">About</a></li>
            </ul>
        </div>
    </body>
</html>