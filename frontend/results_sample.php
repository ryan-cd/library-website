<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Library Search</title>
        <link href="css/stylesheet.css" type="text/css" rel="stylesheet" /> 
        <link href="css/normalize.css" type="text/css" rel="stylesheet" /> 
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet"> 
        <script src="javascript/map.js"></script>
        <script src="javascript/mapAPIKey.js"></script>
        <meta charset="UTF-8">
    </head>
    <body>
        <div class="header">
            <h3 class="logo">Library Search</h3>
            <div class="nav">
                <ul class="nav-list">
                    <li id="search"><a href="search.php">Search</a></li>
                    <li id="add"><a href="submission.php">Add a Library</a></li>
                    <li id="about"><a href="search.php">About</a></li>
                    <li id="login"><a href="registration.php">Login</a></li>
                </ul>
            </div>
        </div>
        
        <div class="content">
            <hr />
            <!-- The spacer class adds vertical space -->
            <div class="spacer"></div>
            <div class="searchbars">
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
            </div>
            
            <div class="spacer"></div>
            <div class="results">
            
                <div id="map"></div>
                <!-- 
                    The following script loads the map into the page. This is the standard way to create a map, as shown
                    on the Google tutorial: https://developers.google.com/maps/documentation/javascript/tutorial.
                    The api key is in a separate file to keep it out of version control. This method of usinig 
                    concatenated strings in a script source was learned from http://stackoverflow.com/questions/11150409/use-js-variable-to-set-the-src-attribute-for-script-tag
                -->
                <script>
                    document.write("<script type='text/javascript' src='" + apiKey.url + "drawMap' async defer><\/scr" + "ipt>");
                </script>
                <!-- Result objects consist of text and a rating to the right, and an image on the left -->
                <div class="result">
                    <img src="images/health-sci-library.jpg" class="result-thumb" alt="health sci library">
                    <div class="result-right">
                        <a href="individual_sample.php" class="result-title">Health Sciences Library</a>
                        <p class="result-description">This library is for studying health sciences.</p>
                        <p class="result-address">1280 Main Street West, Hamilton, ON</p>
                        <img src="images/half-stars.png" class="result-rating" alt="rating">
                    </div>
                </div>
                <div class="result">
                    <img src="images/thode.jpg" class="result-thumb" alt="thode library">
                    <div class="result-right">
                        <a href="individual_sample.php" class="result-title">H.G. Thode Library</a>
                        <p class="result-description">Engineering and Sciences Library</p>
                        <p class="result-address">1280 Main Street West, Hamilton, ON</p>
                        <img src="images/full-stars.png" class="result-rating" alt="rating">
                    </div>
                </div>
                
            </div>
            
        
            <div class="footer">
                <br />
                <hr />
                <p>Copyright (c) 2016 Ryan Davis</p>
                <ul class="nav-list">
                    <li id="about-footer"><a href="search.php">About</a></li>
                </ul>
            </div>
        </div>
    </body>
</html>