<!DOCTYPE html>
<html lang="en">
    <?php include "php-inc/head.inc";
    ?>  
    <script src="javascript/map.js"></script>
    <script src="javascript/mapAPIKey.js"></script>

    <body>
        <?php include "php-inc/header.inc";
        ?>   
         <!-- 
            The following script loads the map into the page. This is the standard way to create a map, as shown
            on the Google tutorial: https://developers.google.com/maps/documentation/javascript/tutorial.
            The api key is in a separate file to keep it out of version control. This method of usinig 
            concatenated strings in a script source was learned from http://stackoverflow.com/questions/11150409/use-js-variable-to-set-the-src-attribute-for-script-tag
        -->
        <script>
            document.write("<script type='text/javascript' src='" + apiKey.url + "init'><\/scr" + "ipt>");
        </script>
        
        <div class="content">
            <hr />
            <?php
                require_once 'php-inc/database.php';
                require_once 'php-inc/result.php';
                require_once 'php-inc/page.php';
                echo '<div class="spacer"></div>';
                echo '<div class="spacer"></div>';
                $name = '';
                $latitude = '';
                $longitude = '';
                $rating = '';
                //Set variables to hold what the user searched for
                if (isset($_GET["name"])) 
                    $name = $_GET["name"];
                if (isset($_GET["location"])) {
                    /* The following lines convert the (lat, long) coordinate pair into two separate
                    variables with precision to the 1/100th.*/
                    $latitude = substr($_GET["location"], 0, strpos($_GET["location"], ","));
                    $latitude = substr($latitude, 0, strpos($latitude, ".") + 3);
                    // Code to handle whether user submits location as "x,y" or "x, y"
                    if(strpos($_GET["location"], " ") !== FALSE) {
                        $separator = " ";
                    } else {
                        $separator = ",";
                    }
                    $longitude = substr($_GET["location"], strpos($_GET["location"], $separator)+1);
                    $longitude = substr($longitude, 0, strpos($longitude, ".") + 3);
                }
                if (isset($_GET["rating"]))
                    $rating = $_GET["rating"];
                echo '<div class="results">';
                echo '<div id="map"></div>';
               
                try {
                    /* Retrieve search results from the database */
                    $pdo = new PDO($connection,$username,$password);
                    $query = 'SELECT * FROM `objects` where 1';
                    
                    if($name != '') {
                        $query = $query.(' and name = "'.$name.'"');
                    }
                    if ($latitude != '' && $longitude != '') {
                        $query = $query.(' and latitude LIKE "'.$latitude.'%" and longitude LIKE "'.$longitude.'%"');
                    }
                    if ($rating != '') {
                        $query = $query.(' and rating >= '.$rating);
                    }
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();
                    
                    foreach ($stmt as $row) { 
                        $location = "Coordinates: ".$row["latitude"].", ".$row["longitude"];
                        generateResult($row["id"], $row["name"], $row["description"], $location, $row["rating"]);
                        generateMap($row);
                    }
                } catch (PDOException $e) {
                    die ("Database error " + $e);
                }
                

            ?>
            </div>
            
            <?php include "php-inc/footer.inc";
            ?>  
        </div>
    </body>
</html>