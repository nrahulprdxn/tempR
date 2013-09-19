<?php

$link = mysql_connect('$IP','nrahulprdxn',''); 
if (!$link) { 
	die('Could not connect to MySQL: ' . mysql_error()); 
}
echo 'Connected successfully';

echo "OKies";
?>