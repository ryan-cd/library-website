<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Library Search</title>
        <link href="css/stylesheet.css" type="text/css" rel="stylesheet" /> <!-- Styles for the site -->
        <link href="css/normalize.css" type="text/css" rel="stylesheet" /> <!-- Normalizes css accross browsers -->
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet"> <!-- Site font -->
        <script src="javascript/dynamics.js"></script>
        <meta charset="UTF-8">
    </head>
    
    <body>
        <div class="header">
            <h3 class="logo">Library Search</h3>
            <!-- The nav bar is a list of simple links -->
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
        
        <div class="footer">
            <hr />
            <p>Copyright (c) 2016 Ryan Davis</p>
            <ul class="nav-list">
                <li id="about-footer"><a href="search.php">About</a></li>
            </ul>
        </div>
    </body>
</html>