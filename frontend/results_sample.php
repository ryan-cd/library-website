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
            <hr />
            <?php
                require_once 'php-inc/database.php';
                require_once 'php-inc/result.php';
                echo'<!-- The spacer class adds vertical space -->';
                echo '<div class="spacer"></div>';
                echo '<div class="spacer"></div>';
                $name = '';
                $latitude = '';
                $longitude = '';
                $rating = '';

                if (isset($_GET["name"])) 
                    $name = $_GET["name"];
                if (isset($_GET["location"])) {
                    /* The following lines convert the (lat, long) coordinate pair into two separate
                    variables with precision to the 1/100th.*/
                    $latitude = substr($_GET["location"], 0, strpos($_GET["location"], ","));
                    $latitude = substr($latitude, 0, strpos($latitude, ".") + 3);
                    $longitude = substr($_GET["location"], strpos($_GET["location"], " ")+1);
                    $longitude = substr($longitude, 0, strpos($longitude, ".") + 3);
                }
                if (isset($_GET["rating"]))
                    $rating = $_GET["rating"];
                echo '<div class="results">';
                echo '<div id="map"></div>';
               
                try {
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
                    //print_r($query);
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();
                    
                    foreach ($stmt as $row) { 
                        $location = "Coordinates: ".$row["latitude"].", ".$row["longitude"];
                        generateResult($row["id"], $row["name"], $row["description"], $location, $row["rating"]);
                    }
                } catch (PDOException $e) {
                    die ("Database error " + $e);
                }
                

            ?>
            <!-- The spacer class adds vertical space -->
            <!--<div class="spacer"></div>-->
            <!--div class="searchbars">
                <div class="form horizontal-form">
                    <form action="search.html" method="get" name="search">
                        <input type="text" id="city" value="Hamilton" name="city">
                        <input type="text" id="advanced-search-name" class="advanced-search" placeholder="Enter library name" name="library-name"> 
                        <select name="rating" id="advanced-search-rating" class="advanced-search">
                            <option value="Minimum Rating">Minimum rating</option>
                            <option value="5 Star">5 Star</option>
                            <option value="4 Star">4 Star</option>
                            <option value="3 Star">3 Star</option>
                            <option value="2 Star">2 Star</option>
                            <option value="1 Star">1 Star</option>
                        </select>
                    </form>
                </div>
            </div-->
            
            <!--div class="spacer"></div-->
            <!--div class="results"-->
            
                <!--div id="map"></div-->
                <!-- 
                    The following script loads the map into the page. This is the standard way to create a map, as shown
                    on the Google tutorial: https://developers.google.com/maps/documentation/javascript/tutorial.
                    The api key is in a separate file to keep it out of version control. This method of usinig 
                    concatenated strings in a script source was learned from http://stackoverflow.com/questions/11150409/use-js-variable-to-set-the-src-attribute-for-script-tag
                -->
                <script>
                    document.write("<script type='text/javascript' src='" + apiKey.url + "drawMap' async defer><\/scr" + "ipt>");
                </script>
                
                
                
            </div>
            
            <?php include "php-inc/footer.inc";
            ?>  
        </div>
    </body>
</html>