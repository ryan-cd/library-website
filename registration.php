<!DOCTYPE html>
<html lang="en">
    <?php include "php-inc/head.inc";
    ?>  
    <script src="javascript/dynamics.js"></script>

    <body>
        <?php include "php-inc/header.inc";
        ?>  
        
        <div class="content">
            <?php 
                require_once 'php-inc/database.php';
                require_once 'php-inc/validate.inc'; //Form validation code
                require_once 'php-inc/accounts.php'; //Code to draw forms
                $login = false;
                $errors = array();
                $numErrors = 0;

                session_start(); //Session used to see whether user is logged in

                //Handle logout 
                if(isset($_POST['logout'])) {
                    session_unset();
                    session_destroy();
                }
                //handle user already being logged in
                else if(isset($_SESSION['login-email'])) {
                    $login = true; 
                }
                //handle when user submits login form
                else if (!isset($_SESSION['login-email']) && isset($_POST['login-email']) && isset($_POST['login-password'])) {
                    //validate email
                    if (!validatePattern($errors, $_POST, 'login-email', '/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,})+$/')) {
                        $numErrors++;
                    }
                    //validate password
                    if(!validatePattern($errors, $_POST, 'login-password', '/^([a-zA-Z0-9_\.\-])/')) {
                        $numErrors++;
                    }
                    if($numErrors == 0) {
                        try {
                            $pdo = new PDO($connection,$username,$password);
                            $stmt = $pdo->prepare('SELECT password FROM `users` where `email`=:email');
                            $stmt->bindValue(':email', $_POST['login-email']);
                            $stmt->execute(); 
                            //$query_errors = $stmt->errorInfo();
                            //check whether the email exists in the database
                            if ($stmt->rowCount() > 0) {
                                foreach ($stmt as $row) {
                                    //check if the password is correct
                                    if (password_verify($_POST["login-password"], $row["password"])) {
                                        $login = true;
                                        //Session variable to keep track of who is logged in
                                        $_SESSION['login-email'] = $_POST['login-email'];
                                    } else {
                                        $errors['login-email'] = "User/password combo doesn't exist";
                                    }
                                }
                            } else {
                                // The email address is not in the database
                                $errors['login-email'] = "Email doesn't exist";
                            }
                        } catch (PDOException $e) {
                            die ("Database error. ".$e);
                        }
                    }
                } 
                //handle when user submits user registration form
                else if (!isset($_SESSION['login-email']) 
                            && isset($_POST['registration-email']) 
                            && isset($_POST['registration-password']) 
                            && isset($_POST['registration-password-confirm'])) {
                    //validate email
                    if (!validatePattern($errors, $_POST, 'registration-email', '/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,})+$/')) {
                        $numErrors++;
                    }
                    //validate password
                    if(!validatePattern($errors, $_POST, 'registration-password', '/^([a-zA-Z0-9_\.\-])/')) {
                        $numErrors++;
                    }
                    //validate password and confirm password match
                    if ($_POST['registration-password'] != $_POST['registration-password-confirm']) {
                        $errors['registration-password-confirm'] = "Passwords don't match";
                        $numErrors++;
                    }
                    //successful validation. Insert new user into database
                    if($numErrors == 0) {
                        try {
                            $pdo = new PDO($connection,$username,$password);
                            //hash and salt the password
                            $hashed_password = password_hash($_POST["registration-password"], PASSWORD_DEFAULT);

                            $stmt = $pdo->prepare('INSERT INTO `users`(`id`, `email`, `password`) VALUES (NULL,:email,:password)');
                            $stmt->bindValue(':email', $_POST['registration-email']);
                            $stmt->bindValue(':password', $hashed_password);
                            $stmt->execute();  
                            $query_errors = $stmt->errorInfo();
                            //print_r($query_errors);
                            if (!isset($errors['registration-email']))
                            { 
                                $login = true;
                                $_SESSION['login-email'] = $_POST['registration-email'];
                            } 
                        } catch (PDOException $e) {
                            die ("Database error. ".$e);
                        }
                    }
                } 
                //Draw the login and registration forms
                generateForms($errors, $login);
            ?>
        </div>

        <?php include "php-inc/footer.inc";
        ?>  
    </body>
</html>
