<?php
//Validates a field with a specific regex. Errors are added to the errors argument
//The following function was taken from the course slides (Lecture 8)
function validatePattern(&$errors, $field_list, $field_name, $pattern)
{
    if (!isset($field_list[$field_name]) || $field_list[$field_name] == '') {
        $errors[$field_name] = 'Required';
        return false;
    } else if (!preg_match($pattern, $field_list[$field_name])) {
        $errors[$field_name] = 'Invalid';
        return false;
    }

    return true;
}
?>