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
    // Validate the Email field
    if (!validateEmail(document.getElementById(
"login-email").value)) {
        if (document.getElementById(
"login-email").value === "") {
            document.getElementById("login-email-error").innerHTML = "Please enter an email address.";
        } else {
            document.getElementById("login-email-error").innerHTML = "Email format is not valid";
        }
        returnValue = false;
    } 
    // Clear the field if there was no error
    else 
    {
        document.getElementById("login-email-error").innerHTML = "";
    }
    
    //Validate the password field
    if (!validatePassword(document.getElementById(
"login-password").value)) {
        document.getElementById("login-password-error").innerHTML = "Please enter a password";
        returnValue = false;
    }
    // Clear the field if there was no error
    else 
    {
        document.getElementById("login-password-error").innerHTML = "";
    }
    return returnValue;
}

function validateRegistration() {
    var returnValue = true; 
    if (document.getElementById("registration-password").value !== document.getElementById("registration-password-confirm").value) {
        document.getElementById("registration-password-confirm-error").innerHTML = "Passwords do not match.";
        returnValue = false;
    } else {
         document.getElementById("registration-password-confirm-error").innerHTML = "";
    }
    
    if (!(validateEmail(document.getElementById("registration-email").value))) {
        if (document.getElementById("registration-email").value === "") {
            document.getElementById("registration-email-error").innerHTML = "Please enter an email";
        } else {
            document.getElementById("registration-email-error").innerHTML = "Email format is invalid";
        }
        returnValue = false;
    } else {
         document.getElementById("registration-email-error").innerHTML = "";
    }
    
    if(!(validatePassword(document.getElementById("registration-password").value))) {
        document.getElementById("registration-password-error").innerHTML = "Please enter a password";
        returnValue = false;
    } else {
        document.getElementById("registration-password-error").innerHTML = "";
    }
    return returnValue;
}

function validateEmail(email) {
    var valid = true;
    // The following regular expression was taken from the course slides (Lecture 6)
    valid = valid &&(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,})+$/.test(email));
    
    return valid;
}

function validatePassword(password) {
    if (password === null || password === "") {
        return false;
    }
    return true;
}

/* END ~~~~~~~~~~~~~ LOCATION FUNCTIONS ~~~~~~~~~~~*/