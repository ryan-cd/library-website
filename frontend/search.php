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
                    <form action="search.html" method="get" name="search">
                        <input type="text" id="library-location" placeholder="Enter a city" name="city">
                        <input type="checkbox" id="my-location-checkbox" value="Use my location"  onclick="getLocation()"> 
                        <label for="my-location-checkbox">Use my location</label>
                        <input type="text" id="advanced-search-name" class="advanced-search" placeholder="Enter a library name" name="library-name"> 
                        <select name="rating" id="advanced-search-rating" class="advanced-search">
                            <option value="Minimum rating">Minimum Rating</option>
                            <option value="5 Star">5 Star</option>
                            <option value="4 Star">4 Star</option>
                            <option value="3 Star">3 Star</option>
                            <option value="2 Star">2 Star</option>
                            <option value="1 Star">1 Star</option>
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