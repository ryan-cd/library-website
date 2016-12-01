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
                require_once 'php-inc/validate.inc';
                require_once 'php-inc/accounts.php';
                $login = false;
                $errors = array();
                $numErrors = 0;

                session_start();

                //Handle logout 
                if(isset($_POST['logout'])) {
                    session_unset();
                    session_destroy();
                }
                //handle user already being logged in
                else if(isset($_SESSION['login-email'])) {
                    $login = true; 
                }
                //handle user login form
                else if (!isset($_SESSION['login-email']) && isset($_POST['login-email']) && isset($_POST['login-password'])) {
                    if (!validatePattern($errors, $_POST, 'login-email', '/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,})+$/')) {
                        $numErrors++;
                    }
                    if(!validatePattern($errors, $_POST, 'login-password', '/^([a-zA-Z0-9_\.\-])/')) {
                        $numErrors++;
                    }
                    //print_r($errors);
                    //print_r($numErrors);
                    if($numErrors == 0) {
                        try {
                            $pdo = new PDO($connection,$username,$password);
                            $stmt = $pdo->prepare('SELECT count(*) as count FROM `users` where `email`=:email and `password`=:password');
                            $stmt->bindValue(':email', $_POST['login-email']);
                            $stmt->bindValue(':password', $_POST['login-password']);
                            $stmt->execute();  
                            //$query_errors = $stmt->errorInfo();
                            if (!isset($errors['login-email'])) {
                                foreach ($stmt as $row) {
                                    if ($row["count"] == 1) {
                                        $login = true;
                                        $_SESSION['login-email'] = $_POST['login-email'];
                                    } else {
                                        $errors['login-email'] = "User/password combo doesn't exist";
                                    }
                                }
                            }
                        } catch (PDOException $e) {
                            die ("Database error. ".$e);
                        }
                    }
                } 
                //handle user registration form
                else if (!isset($_SESSION['login-email']) 
                            && isset($_POST['registration-email']) 
                            && isset($_POST['registration-password']) 
                            && isset($_POST['registration-password-confirm'])) {
                    if (!validatePattern($errors, $_POST, 'registration-email', '/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,})+$/')) {
                        $numErrors++;
                    }
                    if(!validatePattern($errors, $_POST, 'registration-password', '/^([a-zA-Z0-9_\.\-])/')) {
                        $numErrors++;
                    }
                    if ($_POST['registration-password'] != $_POST['registration-password-confirm']) {
                        $errors['registration-password-confirm'] = "Passwords don't match";
                        $numErrors++;
                    }
                    
                    if($numErrors == 0) {
                        try {
                            $pdo = new PDO($connection,$username,$password);
                            //$stmt = $pdo->prepare('SELECT count(*) as count FROM `users` where `email`=:email and `password`=:password');
                            $stmt = $pdo->prepare('INSERT INTO `users`(`id`, `email`, `password`) VALUES (NULL,:email,:password)');
                            $stmt->bindValue(':email', $_POST['registration-email']);
                            $stmt->bindValue(':password', $_POST['registration-password']);
                            $stmt->execute();  
                            $query_errors = $stmt->errorInfo();
                            //print_r($query_errors);
                            if (!isset($errors['registration-email']))
                            { 
                                    $login = true;
                                    $_SESSION['login-email'] = $_POST['registration-email'];
                                    echo "\nLogin valid";
                            } 
                        } catch (PDOException $e) {
                            die ("Database error. ".$e);
                        }
                    }
                } 

                generateForms($errors, $login);
            ?>
        </div>
        

        <?php include "php-inc/footer.inc";
        ?>  
    </body>
</html>
