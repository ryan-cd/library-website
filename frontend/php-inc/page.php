<?php
//Generates individual object page
function generatePage($id, $title, $description, $rating) {
    echo 
        '<h1 class="main-header">'.$title.'</h1>'.
        '<h2 class="main-header">'.$description.'</h2>'.
        '<h3 class="main-header">'.$rating.'/5 stars</h3>'.
        '<img src="images/thode.jpg" class="large-profile-img" alt="library-image">';
}

//Creates the map with a marker at the specified location
function generateMap($row) {
    echo "<script type='text/javascript'>\n";
    echo "var marker = {lat: parseFloat(".$row["latitude"]."), lng: parseFloat(".$row["longitude"].")};\n";
    echo "addMarker(marker, createInfoString('".$row["id"]."', '".$row["name"]."', '".$row["description"]."'));";
    echo "</script>\n";
}

//The form to add reviews
function generateAddReview() {
    //Note session should have already been started
    if (isset($_SESSION["login-email"])) {
        echo 
            '<div class="spacer"></div>'.
                '<div class="form horizontal-form">'.
                    '<h3 class="main-header">Add a review</h3>'.
                    '<form method="post" name="search">'.
                        '<input type="text" id="review" placeholder="Enter a review" name="review" required> '.
                        '<select name="rating" id="advanced-search-rating" class="advanced-search">'.
                            '<option value="1">Rating</option>'.
                            '<option value="5">5 Stars</option>'.
                            '<option value="4">4 Stars</option>'.
                            '<option value="3">3 Stars</option>'.
                            '<option value="2">2 Stars</option>'.
                            '<option value="1">1 Star</option>'.
                        '</select>'.
                        '<input type="submit" value="Submit">'.
                    '</form>'.
                '</div>';
    } else {
        echo '<h3 class="main-header">You must log in to post a review</h3>';
    }
}

//Draws the review of a specified user
function generateReview($row) {
    echo
        '<div class="spacer"></div>'.
        '<div class="result">'.
            '<img src="images/woman.jpg" class="result-thumb" alt="user-image">'.
            '<div class="result-right">'.
                '<a href="#" class="result-title">'.$row["user"].'</a>'.
                '<p class="result-description">'.$row["rating"].'/5 stars</p>'.
                '<p class="result-description">'.$row["review"].'</p>'.
            '</div>'.
        '</div>';
}
?>