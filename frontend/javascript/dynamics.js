'use strict';

/* START ~~~~~~~~~~~~~ LOCATION FUNCTIONS ~~~~~~~~~~~*/
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(setLocationCB, locationErrorCB);
    } else {
        alert("This browser doesn't support geolocation.");
    }   
}

function setLocationCB(location) {
    document.getElementById("city-search").value = location.coords.latitude + ", " + location.coords.longitude;
}

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

function validateLogin() {
    var returnValue = true;
    if (!validateEmail(document.getElementById(
"login-email").value)) {
        returnValue = false;
    } else if (!validatePassword(document.getElementById(
"login-password").value)) {
        returnValue = false;
    }
    return returnValue;
}

function validateRegistration() {
    var returnValue = true; 
    if (document.getElementById("registration-password").value !== document.getElementById("registration-password-confirm").value) {
        alert("The two passwords must match")
        returnValue = returnValue && false;
    }
    returnValue = returnValue && validateEmail(document.getElementById("registration-email").value);
    returnValue = returnValue && validatePassword(document.getElementById("registration-password").value);
    return returnValue;
}

function validateEmail(email) {
    var valid = true;
    // The following regular expression was taken from the course slides (Lecture 6)
    valid = valid &&(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,})+$/.test(email));
    
    if (!valid) {
        alert("Please enter a valid email address");
    }
    return valid;
}

function validatePassword(password) {
    if (password == null || password == "") {
        alert("Please enter a password");
        return false;
    } 
    return true;
}

/* END ~~~~~~~~~~~~~ LOCATION FUNCTIONS ~~~~~~~~~~~*/