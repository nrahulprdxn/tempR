<?php

/* Set database variables here for localhost*/
//$host = 'localhost';         // Set host name of database
//$username = 'root';         // Set database username
//$password = '';            // Set database password
//$dbname = 'webvantage';   // Set database name
//$dbpre = 'in';           // Set table prefix
//$dbt = '_users';

/* Set database variables here for C9*/
$host = getenv("IP");          // Set host name of database
$username = 'nrahulprdxn';      // Set database username
$password = '';                // Set database password
$dbname = 'c9';               // Set database name
$dbpre = 'in';               // Set table prefix
$dbt = '_users';

/* Connection to database */
$mysqli = new mysqli($host, $username, $password, $dbname);

 $q = 'SELECT * FROM '. $dbpre . $dbt;
   
 $result = $mysqli->query( $q );
 while($row = mysqli_fetch_array($result)) : 
   print_r($row);
 endwhile;  
?>