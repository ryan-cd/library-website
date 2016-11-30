<?php
function generateObject($id, $title, $description, $rating) {
    echo 
        '<a href="results_sample.php" class="back-link">Back to results</a>'.
        '<h1 class="main-header">'.$title.'</h1>'.
        '<h2 class="main-header">'.$description.'</h2>'.
        '<img src="images/thode.jpg" class="large-profile-img" alt="library-image">';
}
?>