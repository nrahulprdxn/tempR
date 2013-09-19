<?php

/* Set base url or domain name here */
$baseurl = 'https://temps-c9-nrahulprdxn.c9.io/';

/* Set database variables here */
$host = getenv("IP");            // Set host name of database
$username = 'nrahulprdxn';      // Set database username
$password = '';                // Set database password
$dbname = 'c9';               // Set database name
$dbpre = 'in';               // Set table prefix

/* Connection to database */
$mysqli = new mysqli($host, $username, $password, $dbname);

/**/
?>