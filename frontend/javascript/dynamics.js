'use strict';

/* START ~~~~~~~~~~~~~ LOCATION FUNCTIONS ~~~~~~~~~~~*/
/* When the user checks the box, their location coordinates get filled into the location box */
function getLocation() {
    if (navigator.geolocation) {
        if (document.getElementById("my-location-checkbox").checked) {
            navigator.geolocation.getCurrentPosition(setLocationCB, locationErrorCB);
        } else {
            document.getElementById("library-location").value = "";
        }
        
    } else {
        alert("This browser doesn't support geolocation.");
    }
}

/* This function takes a pair of coordnates, and fills them into the location field on the form */
function setLocationCB(location) {
    document.getElementById("library-location").value = location.coords.latitude + ", " + location.coords.longitude;
}

/* This function alerts the user if there was a geolocation error */
function locationErrorCB(error) {
    switch (error.code) {
        case error.TIMEOUT:
            alert("Location request timed out");
            break;
        case error.POSITION_UNAVAILABLE:
            alert("Location unavailable");
            break;
        case error.PERMISSION_DENIED:
            alert("Location request requires your permission");
            break;
        case error.UNKNOWN_ERROR:
            alert("Location request had an unknown error");
            break;
    }
}

/* END ~~~~~~~~~~~~~ LOCATION FUNCTIONS ~~~~~~~~~~~*/

/* START ~~~~~~~~~~~~~ VALIDATION FUNCTIONS ~~~~~~~~~~~*/

/* This function validates all the fields for login */
function validateLogin() {
    var returnValue = true;
    
    /* These functions check that the email is non empty, and that it is valid. The appropriate error will be filled in
    to the form by the check function */
    if (!check(nonEmpty, document.getElementById("login-email").value, "login-email-error", "Please enter an email address")) {
        returnValue = false;
    } else if (!check(validateEmail, document.getElementById("login-email").value, "login-email-error", "Email format is not valid")) {
        returnValue = false;
    } 
    
    /* Check whether the password field is non empty. Show the error message if needed */
    if (!check(nonEmpty, document.getElementById("login-password").value, "login-password-error", "Please enter a password")) {
        returnValue = false;
    }
    return returnValue;
}

/* This function validates all fields in the Registration box */
function validateRegistration() {
    var returnValue = true;
    
    /* Check if password and confirm password match */
    if (!check(
        function(password) { return password === document.getElementById("registration-password-confirm").value },
        document.getElementById("registration-password").value,
        "registration-password-confirm-error",
        "Passwords do not match")) {
        returnValue = false;
    }
    
    /* Ensure the email field is filled out and valid */
    if (!check(nonEmpty, document.getElementById("registration-email").value, "registration-email-error", "Please enter an email address")) {
        returnValue = false;
    } else if (!check(validateEmail, document.getElementById("registration-email").value, "registration-email-error", "Email format is not valid")) {
        returnValue = false;
    } 
    
    /* Ensures the password is filled out */
    if (!check(nonEmpty, document.getElementById("registration-password").value, "registration-password-error", "Please enter a password")) {
        returnValue = false;
    }
    
    return returnValue;
}

/* Function returns true when the input email is valid */
function validateEmail(email) {
    // The following regular expression was taken from the course slides (Lecture 6)
    var valid = (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,})+$/.test(email));
    
    return valid;
}

/* This function validates all fields in the library submission form. 
Any errors will be displayed within the form */
function validateLibrarySubmission() {
    var numErrors = 0;
    if (!(check(nonEmpty, document.getElementById("library-name").value, "library-name-error", "Please enter a name."))) {
        numErrors++;
    }
    
    if (!(check(nonEmpty, document.getElementById("library-description").value, "library-description-error", "Please enter a description."))) {
        numErrors++;
    }
    
    /* Library descriptions must be at least 10 characters */
    if (!(check(atLeast10Chars, document.getElementById("library-description").value, "library-description-error", "Minimum 10 characters"))) {
        numErrors++;
    }
    
    if (!(check(nonEmpty, document.getElementById("library-location").value, "library-location-error", "Please enter a location."))) {
        numErrors++;
    }
    
    /* Coordinates entered by the user must be valid */
    if (!(check(isCoordinatePair, document.getElementById("library-location").value, "library-location-error", "Please enter valid coordinates."))) {
        numErrors++;
    }
    
    return numErrors === 0;
}

/* Funtion inputs: (check to perform, input to validate, which html id should show the error message, the error message).
The function will return true if the validation passes. Otherwise it will add the error message to the 
form, and return false */
function check(checkFunction, value, errorElementId, message) {
    console.log(errorElementId + " " + message);
    var valid = checkFunction(value);
    if (!valid) {
        document.getElementById(errorElementId).innerHTML = message;
    } else {
        document.getElementById(errorElementId).innerHTML = "";
    }
    return valid;
}

/* Return true if input is not empty */
function nonEmpty(value) {
    return value !== "";
}

function atLeast10Chars(value) {
    return value.length >= 10;
}

/* Returns true if coordinates are valid */
function isCoordinatePair(value) {
    // Attribution: Coordinates regex is from:
    // http://stackoverflow.com/questions/3518504/regular-expression-for-matching-latitude-longitude-coordinates
    return /^[-+]?([1-8]?\d(\.\d+)?|90(\.0+)?),\s*[-+]?(180(\.0+)?|((1[0-7]\d)|([1-9]?\d))(\.\d+)?)$/.test(value);
}
/* END ~~~~~~~~~~~~~ VALIDATION FUNCTIONS ~~~~~~~~~~~*/