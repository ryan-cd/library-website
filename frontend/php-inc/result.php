<?php
    //Generates a result element for the results page
    function generateResult ($id, $name, $description, $location, $rating) {
        echo 
            '<!-- Result objects consist of text and a rating to the right, and an image on the left -->'.
            '<div class="result">'.
                '<img src="images/health-sci-library.jpg" class="result-thumb" alt="health sci library">'.
                '<div class="result-right">'.
                    '<a href="individual_sample.php?id='.$id.'"'.' class="result-title">'.$name.'</a>'.
                    '<p class="result-description">'.$description.'</p>'.
                    '<p class="result-address">'.$location.'</p>'.
                    '<p class="result-description">Rating: '.$rating.'/5</p>'.
                '</div>'.
            '</div>';
}
?>