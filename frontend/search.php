<!DOCTYPE html>
<html lang="en">
    <?php include "php-inc/head.inc";
    ?> 
    <script src="javascript/dynamics.js"></script>
    
    <body>
        <?php include "php-inc/header.inc";
        ?> 

        <div class="content">
            <!-- The banner class is the resizing wrapper image that surrounds the whole site -->
            <div id="banner">
                <div class="form vertical-form vertical-form-center">
                    <h1 class="main-header">Find a library</h1>
                    <form action="results_sample.php" method="get" name="search">
                        <input type="text" id="library-location" placeholder="Enter coords (e.g. 43.2602, -79.9205)" name="location">
                        <input type="checkbox" id="my-location-checkbox" value="Use my location"  onclick="getLocation()"> 
                        <label for="my-location-checkbox">Use my location</label>
                        <input type="text" id="advanced-search-name" class="advanced-search" placeholder="Enter a library name" name="name"> 
                        <select name="rating" id="advanced-search-rating" class="advanced-search">
                            <option value="1">Minimum Rating</option>
                            <option value="5">Min 5 Stars</option>
                            <option value="4">Min 4 Stars</option>
                            <option value="3">Min 3 Stars</option>
                            <option value="2">Min 2 Stars</option>
                            <option value="1">Min 1 Star</option>
                        </select>
                        <input type="submit" id="search-button" value="Search">
                    </form>
                </div>
            </div>
        </div>
        
        <?php include "php-inc/footer.inc";
        ?>  
    </body>
</html>