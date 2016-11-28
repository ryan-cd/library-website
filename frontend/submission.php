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
                <div class="form vertical-form vertical-form-center">
                    <h1 class="main-header">Add a library</h1>
                    <form method="post" name="search" onsubmit="return validateLibrarySubmission();">
                        <input type="text" id="library-name" placeholder="Enter library name" name="name" required> 
                        <p id="library-name-error"></p>
                        <input id="library-description" type="text" placeholder="Enter a description" name="description" required>
                        <p id="library-description-error"></p>
                        <input type="text" id="library-location" placeholder="Enter coordinates (i.e. 45, 10)" name="location" required> 
                        <p id="library-location-error"></p>
                        <input type="checkbox" id="my-location-checkbox" value="Use my location"  onclick="getLocation()"> 
                        <label for="my-location-checkbox">Use my location</label>
                        <input type="file" id="library-image" name="image-upload" accept="image/*" required>  <!-- This filter only accepts image types -->
                        <p id="library-image-error"></p>
                        <input type="submit" value="Add">
                    </form>
                </div>
            </div>
            <?php
                require_once 'php-inc/database.php';
                require_once 'php-inc/validate.inc';
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
            ?>
        </div>
        
        <?php include "php-inc/footer.inc";
        ?>  
    </body>
</html>