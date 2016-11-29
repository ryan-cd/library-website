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
                require_once 'php-inc/submission_form.php';
                $numErrors = 0;
                $errors = array();
                if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['location'])) {
                    if(!validatePattern($errors, $_POST, 'name', '/^([a-zA-Z0-9_\.\-])/')) {
                        $numErrors++;
                    }
                    if(!validatePattern($errors, $_POST, 'description', '/^([a-zA-Z0-9_\.\-]{10,})/')) {
                        $numErrors++;
                    }
                    if(!validatePattern($errors, $_POST, 'location', '/^[-+]?([1-8]?\d(\.\d+)?|90(\.0+)?),\s*[-+]?(180(\.0+)?|((1[0-7]\d)|([1-9]?\d))(\.\d+)?)$/')) {
                        $numErrors++;
                    }
                    //print_r($errors);
                    //print_r($numErrors);
                    if($numErrors == 0) {
                        try {
                            $pdo = new PDO($connection,$username,$password);
                            $stmt = $pdo->prepare('INSERT INTO `objects`(`id`, `name`, `description`, `latitude`, `longitude`) VALUES (NULL,:name,:description,:latitude,:longitude)');
                            $stmt->bindValue(':name', $_POST['name']);
                            $stmt->bindValue(':description', $_POST['description']);
                            $stmt->bindValue(':latitude', 1);
                            $stmt->bindValue(':longitude', 1);

                            $stmt->execute();  
                            //$query_errors = $stmt->errorInfo();
                            
                        } catch (PDOException $e) {
                            die ("Database error. ".$e);
                        }
                    } 
                }

                generateForm($errors);
            ?>
        </div>
        
        <?php include "php-inc/footer.inc";
        ?>  
    </body>
</html>