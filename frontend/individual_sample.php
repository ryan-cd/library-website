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
                <a href="results_sample.php" class="back-link">Back to results</a>
                <h1 class="main-header">Thode Library</h1>
                <img src="images/thode.jpg" class="large-profile-img" alt="thode library">
                
                <div id="map"></div>
                <!-- 
                    The following script loads the map into the page. This is the standard way to create a map, as shown
                    on the Google tutorial: https://developers.google.com/maps/documentation/javascript/tutorial.
                    The api key is in a separate file to keep it out of version control. This method of usinig 
                    concatenated strings in a script source was learned from http://stackoverflow.com/questions/11150409/use-js-variable-to-set-the-src-attribute-for-script-tag
                -->
                <script>
                    document.write("<script type='text/javascript' src='" + apiKey.url + "initThodeMap' async defer><\/scr" + "ipt>");
                </script>
                
                <div class="spacer"></div>
                <div class="spacer"></div>
                <div class="result">
                    <img src="images/woman.jpg" class="result-thumb" alt="user">
                    <div class="result-right">
                        <a href="individual_sample.php" class="result-title">user91</a>
                        <img src="images/full-stars.png" class="result-rating" alt="rating">
                        <p class="result-description">Great study area!</p>
                        <p class="result-description">I come here all the time when studying for finals.  There are lots of seats, probably the most seating out of all the McMaster libraries.</p>
                    </div>
                </div>
            </div>
            </div>
        </div>
        
        <?php include "php-inc/footer.inc";
        ?> 
    </body>
</html>