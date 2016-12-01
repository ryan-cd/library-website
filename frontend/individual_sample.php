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
                        require_once 'php-inc/object.php';
                        require_once 'php-inc/database.php';
                        try {
                            $pdo = new PDO($connection,$username,$password);
                            $query = 'SELECT * FROM `objects` where `id`=:id';
    
                            $stmt = $pdo->prepare($query);
                            $stmt->bindValue(':id', $_GET["id"]);

                            $stmt->execute();
                            
                            foreach ($stmt as $row) { 
                                generateObject($row["id"], $row["name"], $row["description"], $row["rating"]); 
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
                    
                    <?php
                        generateMap($row); 
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