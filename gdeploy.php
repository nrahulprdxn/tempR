<html>
  <head>
    <title>
      Deploy From Git
    </title>
  </head>
  <body style="background-color: #000;">
    <div style="width: 960px; color: #ff4; border: 1px dotted red; margin: 0 auto">
      <form method="post" action="" >
        <input type="submit" value="Check Out" name="one"/>
        <input type="submit" value="TBD" name="two"/>
        <input type="submit" value="TBD" name="three"/>
      </form>
  





<?php 
/**
* Git Pull
*/
if(isset ($_POST['one'])){
  
  exec('git pull origin master', $shell_output, $output);
  print_r($shell_output);
  print_r($output);
  print_r($_POST);
  
} 
elseif(isset ($_POST['two'])){
  
  print_r($_POST);

} 
elseif(isset ($_POST['three'])){

  print_r($_POST);
  
} else {
  
  echo "Nothing selected";
  
}

/**
 * Database actions
 * 
 */
$host = getenv("IP");            // Set host name of database
$username = 'nrahulprdxn';      // Set database username
$password = '';                // Set database password
$dbname = 'c9';               // Set database name
$dbpre = 'in';               // Set table prefix

$mysqli = new mysqli($host, $username, $password, $dbname);

$q = "SHOW TABLES";
$op = $mysqli->query($q);
echo "<p style='color: #fff'>List of Tables</p>";
while ($row = mysqli_fetch_array($op)) {
  
   echo $row['Tables_in_c9'] . ".<br />";
   
}


?>
  </div>
  </body>
</html>