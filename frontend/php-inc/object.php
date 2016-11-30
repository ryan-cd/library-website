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
?>