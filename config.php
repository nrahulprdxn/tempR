<?php

/* Set base url or domain name here */
$baseurl = 'http://localhost/webvantage/';

/* Set database variables here */
$host = 'localhost';     // Set host name of database
$username = 'root';      // Set database username
$password = '';          // Set database password
$dbname = 'webvantage';  // Set database name
$dbpre = 'in';           // Set table prefix

/* Connection to database */
$mysqli = new mysqli($host, $username, $password, $dbname);

/**/
?>