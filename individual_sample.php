<!DOCTYPE html>
<html lang="en">
    <?php include "php-inc/head.inc";
    ?> 
    <script src="javascript/map.js"></script>
    <script src="javascript/mapAPIKey.js"></script>

    <body>
        <?php include "php-inc/header.inc";
        ?>  
        
        <div class="content">
            <div id="banner">
                <div class="spacer"></div>
                <div class="spacer"></div>
                <div class="spacer"></div>
                <!-- The review section and reviews function the same way as the result section and results from registration_sample.html -->
                <div class="results">
                    <?php
                    //Session started to find out if user has logged in
                    session_start();
                        require_once 'php-inc/page.php'; //code to generate the page
                        require_once 'php-inc/database.php'; //code to perform database functions
                        try {
                            $pdo = new PDO($connection,$username,$password); //connect to database
                            
                            //If the user had posted a review, add it to the database
                            if(isset($_SESSION["login-email"]) && isset($_POST["review"]) && isset($_POST["rating"])) {
                                //Add the user review
                                $query = 'INSERT INTO `reviews`(`id`, `user`, `review`, `rating`) VALUES (:id,:user,:review,:rating)';
                                $stmt = $pdo->prepare($query);
                                $stmt->bindValue(':id', $_GET["id"]);
                                $stmt->bindValue(':user', $_SESSION["login-email"]);
                                $stmt->bindValue(':review', $_POST["review"]);
                                $stmt->bindValue(':rating', $_POST["rating"]);
                                $stmt->execute();

                                //Determine the new aggregate rating and add that to the database
                                $query = 'SELECT rating FROM `reviews` WHERE `id`=:id';
                                $stmt = $pdo->prepare($query);
                                $stmt->bindValue(':id', $_GET["id"]);
                                $stmt->execute();

                                $rating = 0;
                                foreach($stmt as $row) {
                                    $rating += $row["rating"];
                                }
                                $rating = $rating / $stmt->rowCount();

                                $query = 'UPDATE `objects` SET `rating`=:rating WHERE `id`=:id';
                                $stmt = $pdo->prepare($query);
                                $stmt->bindValue(':id', $_GET["id"]);
                                $stmt->bindValue(':rating', $rating);
                                $stmt->execute();
                            }
                            /* Grab the page information, and draw it */
                            $query = 'SELECT * FROM `objects` where `id`=:id';
    
                            $stmt = $pdo->prepare($query);
                            $stmt->bindValue(':id', $_GET["id"]);

                            $stmt->execute();
                            
                            foreach ($stmt as $row) { 
                                generatePage($row["id"], $row["name"], $row["description"], $row["rating"]); 
                            }
                        } catch (PDOException $e) {
                            die ("Database error " + $e);
                        }
                    ?>
                    
                    
                    <div id="map"></div>
                    <!-- 
                        The following script loads the map into the page. This is the standard way to create a map, as shown
                        on the Google tutorial: https://developers.google.com/maps/documentation/javascript/tutorial.
                        The api key is in a separate file to keep it out of version control. This method of usinig 
                        concatenated strings in a script source was learned from http://stackoverflow.com/questions/11150409/use-js-variable-to-set-the-src-attribute-for-script-tag
                    -->
                    <script>
                        document.write("<script type='text/javascript' src='" + apiKey.url + "init'><\/scr" + "ipt>");
                    </script>
                    <div class="spacer"></div>
                    <?php
                        generateMap($row); 

                        generateAddReview();
                        //Draw all the reviews
                        try {
                            $query = 'SELECT * FROM `reviews` where `id`=:id';
    
                            $stmt = $pdo->prepare($query);
                            $stmt->bindValue(':id', $_GET["id"]);

                            $stmt->execute();
                            
                            foreach ($stmt as $row) { 
                                generateReview($row); 
                            }
                        } catch (PDOException $e) {
                            die ("Database error " + $e);
                        }
                    ?>

                </div>
            </div>
        </div>
        
        <?php include "php-inc/footer.inc";
        ?> 
    </body>
</html>