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
        alert("Email invalid");
        returnValue = false;
    } else if (!validatePassword(document.getElementById(
"login-password").value)) {
        alert("Password invalid");
        returnValue = false;
    }
    return returnValue;
}

function validateRegistration() {
    
}

function validateEmail(email) {
    var valid = true;
    valid = valid && (email !== null && email !== "");
    return valid;
}

function validatePassword(password) {
    return password !== null && password !== "";
}

/* END ~~~~~~~~~~~~~ LOCATION FUNCTIONS ~~~~~~~~~~~*/