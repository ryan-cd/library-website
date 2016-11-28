<!DOCTYPE html>
<html lang="en">
    <?php include "php-inc/head.inc";
    ?>  
    <script src="javascript/dynamics.js"></script>

    <body>
        <?php include "php-inc/header.inc";
        ?>  
        
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

        <?php include "php-inc/footer.inc";
        ?>  
    </body>
</html>