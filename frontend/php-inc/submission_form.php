<?php
    function generateForm($errors) {
        if (!isset($errors['name']))
            $errors['name'] = "";
        if (!isset($errors['description']))
            $errors['description'] = "";
        if (!isset($errors['location']))
            $errors['location'] = "";
       
        echo 
            '<div id="banner">'.
                '<div class="form vertical-form vertical-form-center">'.
                    '<h1 class="main-header">Add a library</h1>'.
                    '<form method="post" enctype="multipart/form-data" name="search" onsubmit="return validateLibrarySubmission();">'.
                        '<input type="text" id="library-name" placeholder="Enter library name" name="name" required> '.
                        '<p id="library-name-error">'.$errors['name'].'</p>'.
                        '<input id="library-description" type="text" placeholder="Enter a description" name="description" required>'.
                        '<p id="library-description-error">'.$errors['description'].'</p>'.
                        '<input type="text" id="library-location" placeholder="Enter coordinates (i.e. 45, 10)" name="location" required> '.
                        '<p id="library-location-error">'.$errors['location'].'</p>'.
                        '<input type="checkbox" id="my-location-checkbox" value="Use my location"  onclick="getLocation()"> '.
                        '<label for="my-location-checkbox">Use my location</label>'.
                        '<input type="file" id="library-image" name="image-upload" accept="image/*" required>  <!-- This filter only accepts image types -->'.
                        '<p id="library-image-error"></p>'.
                        '<input type="submit" value="Add">'.
                    '</form>'.
                '</div>'.
            '</div>';
        
    }
?>