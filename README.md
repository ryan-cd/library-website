# library-website


## Description
This repository host a fully featured frontend and backend for a library searching website. Users can login, search/filter for libraries, view and add reviews, add new libraries, and view every library on an embedded map. Each page is optimized for desktop and mobile phone viewing. The site is hosted with Amazon Web Services, and is served over HTTPS.

## Under the Hood
![alt-text](http://i.imgur.com/Szk3LUO.jpg "Main Page")
The landing pages are built with HTML, CSS, PHP, and JavaScript. The user's location is fetched with the HTML5 Geolocation API. 

![alt-text](http://i.imgur.com/gP0PpbB.jpg "Results Page")
Library objects with their reviews are stored in a MySQL database on the server. 

![alt-text](http://i.imgur.com/WVZFfHG.jpg "Individual Result Page")
If a user is logged in they can leave a review and a rating. The embedded maps are rendered from the Google Maps API. The images for users and libraries are stored in an Amazon S3 bucket.

![alt-text](http://i.imgur.com/RGZXAZf.jpg "Registration Page")
Information entered into the registration page will be validated with HTML5 and JavaScript on the client side, and then by PHP on the server side. After this, the login gets salted, hashed, and stored in the database. 

![alt-text](http://i.imgur.com/E871msB.jpg "Object Submission Page")
This page lets a logged in user add a new library to the site. The image gets stored in an Amazon S3 bucket.
