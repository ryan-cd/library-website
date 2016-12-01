<?php
function generateObject($id, $title, $description, $rating) {
    echo 
        '<h1 class="main-header">'.$title.'</h1>'.
        '<h2 class="main-header">'.$description.'</h2>'.
        '<img src="images/thode.jpg" class="large-profile-img" alt="library-image">';
}

function generateMap($row) {
    echo "<script type='text/javascript'>\n";
    echo "var marker = {lat: parseFloat(".$row["latitude"]."), lng: parseFloat(".$row["longitude"].")};\n";
    echo "addMarker(marker, createInfoString('".$row["id"]."', '".$row["name"]."', '".$row["description"]."'));";
    echo "</script>\n";
}

function generateReview($row) {
    echo
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