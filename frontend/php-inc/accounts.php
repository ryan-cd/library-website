<?php
    //Generates login and registration forms with inline errors
    function generateForms($errors, $complete) {
        if (!isset($errors['login-email']))
            $errors['login-email'] = "";
        if (!isset($errors['login-password']))
            $errors['login-password'] = "";
        if (!isset($errors['registration-email']))
            $errors['registration-email'] = "";
        if (!isset($errors['registration-password']))
            $errors['registration-password'] = "";
        if (!isset($errors['registration-password-confirm']))
            $errors['registration-password-confirm'] = "";
        echo '<div id="banner">';
        if (!$complete) {
            echo 
                    '<!-- The two following forms will appear on the left and right sides of the page. -->'.
                    '<div class="form vertical-form vertical-form-left">'.
                        '<h1 class="main-header">Login</h1>'.
                        '<form method="post" name="search" onsubmit="return validateLogin();">'.
                            '<input type="email" id="login-email" placeholder="Email" name="login-email">'.
                            '<p id="login-email-error">'.$errors['login-email'].'</p>'.
                            '<input type="password" id="login-password" placeholder="Password" name="login-password">'.
                            '<p id="login-password-error">'.$errors['login-password'].'</p>'.
                            '<input type="submit" value="Login">'.
                        '</form>'.
                    '</div>'.
                    '<div class="form vertical-form vertical-form-right">'.
                        '<h1 class="main-header">Register</h1>'.
                        '<form method="post" name="search" onsubmit="return validateRegistration();">'.
                            '<input type="email" id="registration-email" placeholder="Email" name="registration-email">'. 
                            '<p id="registration-email-error"></p>'.
                            '<input type="password" id="registration-password" placeholder="Password" name="registration-password">'.
                            '<p id="registration-password-error"></p>'.
                            '<input type="password" id="registration-password-confirm" placeholder="Confirm Password" name="registration-password-confirm">'.
                            '<p id="registration-password-confirm-error"></p>'.
                            '<input type="submit" value="Register">'.
                        '</form>'.
                    '</div>';
        } else {
            echo '<div class="form vertical-form vertical-form-left">';
            echo '<h1 class="main-header">Logged in as '.$_SESSION['login-email'].'</h1>';
            echo '<form method="POST">';
            echo '<input type="submit" value="Logout" name="logout">';
            echo '</form>';
            echo '</div>';
        }
        echo '</div>';
    }
?>