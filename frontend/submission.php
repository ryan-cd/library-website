<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Library Search</title>
        <link href="css/stylesheet.css" type="text/css" rel="stylesheet" />
        <link href="css/normalize.css" type="text/css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <script src="javascript/dynamics.js"></script>
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
            <div id="banner">
                <div class="form vertical-form vertical-form-center">
                    <h1 class="main-header">Add a library</h1>
                    <form action="search.html" method="get" name="search" onsubmit="return validateLibrarySubmission();">
                        <input type="text" id="library-name" placeholder="Enter library name" name="library-name" required> 
                        <p id="library-name-error"></p>
                        <input id="library-description" type="text" placeholder="Enter a description" name="description" required>
                        <p id="library-description-error"></p>
                        <input type="text" id="library-location" placeholder="Enter coordinates (i.e. 45, 10)" name="location" required> 
                        <p id="library-location-error"></p>
                        <input type="checkbox" id="my-location-checkbox" value="Use my location"  onclick="getLocation()"> 
                        <label for="my-location-checkbox">Use my location</label>
                        <input type="file" id="library-image" name="image-upload" accept="image/*" required>  <!-- This filter only accepts image types -->
                        <p id="library-image-error"></p>
                        <input type="submit" value="Add">
                    </form>
                </div>
            </div>
        </div>
        
        <div class="footer">
            <hr/>
            <p>Copyright (c) 2016 Ryan Davis</p>
            <ul class="nav-list">
                <li id="about-footer"><a href="search.php">About</a></li>
            </ul>
        </div>
    </body>
</html>