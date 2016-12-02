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
                use Aws\S3\Exception\S3Exception;
                require_once 'php-inc/database.php';
                require_once 'php-inc/validate.inc';
                require_once 'php-inc/submission_form.php';
                require_once '../s3.php';

                //Attribution: This image code was taken from https://www.youtube.com/watch?v=BR787aefMfY
                if (isset ($_FILES['image-upload'])) {
                    $file = $_FILES['image-upload'];

                    $name = $file['name'];
                    $tmp_name = $file['tmp_name'];
                    $extension = explode('.', $name);
                    $extension = strtolower(end($extension));

                     $key = md5(uniqid());
                     
                     $tmp_file_name = "{$key}.{$extension}";
                     $tmp_file_path = "images/{$tmp_file_name}";

                     move_uploaded_file($tmp_name, $tmp_file_path);

                     try {
                        $s3->putObject([
                            'Bucket' => $config['s3']['bucket'],
                            'Key' => "uploads/{$name}",
                            'Body' => fopen($tmp_file_path, 'rb'),
                            'ACL' => 'public-read'
                        ]);
                        unlink($tmp_file_path);
                     } catch (S3Exception $e) {
                         die ("Error uploading file".$e);
                     }
                }

                $numErrors = 0;
                $errors = array();
                if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['location'])) {
                    if(!validatePattern($errors, $_POST, 'name', '/^([a-zA-Z0-9_\.\-])/')) {
                        $numErrors++;
                    }
                    if (strlen($_POST["description"]) < 10) {
                        $numErrors++;
                        $errors["description"] = "Min 10 characters";
                    }
                    if(!validatePattern($errors, $_POST, 'location', '/^[-+]?([1-8]?\d(\.\d+)?|90(\.0+)?),\s*[-+]?(180(\.0+)?|((1[0-7]\d)|([1-9]?\d))(\.\d+)?)$/')) {
                        $numErrors++;
                    }
                    
                    if($numErrors == 0) {
                        try {
                            $latitude = substr($_POST["location"], 0, strpos($_POST["location"], ","));
                            $longitude = substr($_POST["location"], strpos($_POST["location"], " ")+1);

                            $pdo = new PDO($connection,$username,$password);
                            $stmt = $pdo->prepare('INSERT INTO `objects`(`id`, `name`, `description`, `latitude`, `longitude`) VALUES (NULL,:name,:description,:latitude,:longitude)');
                            $stmt->bindValue(':name', $_POST['name']);
                            $stmt->bindValue(':description', $_POST['description']);
                            $stmt->bindValue(':latitude', $latitude);
                            $stmt->bindValue(':longitude', $longitude);

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