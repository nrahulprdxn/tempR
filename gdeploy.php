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
        <input type="submit" value="Drop Database" name="two"/>
        <input type="submit" value="Import SQL" name="three"/>
         <input type="submit" value="Import SQL" name="four"/>
      </form>
  





<?php 
/**
* Git Pull
*/
$host = getenv("IP");            // Set host name of database
$username = 'nrahulprdxn';      // Set database username
$password = '';                // Set database password
$dbname = 'c9';               // Set database name
$dbpre = 'in';               // Set table prefix

$mysqli = new mysqli($host, $username, $password, $dbname);

if(isset ($_POST['one'])){
  
  exec('git pull origin master', $shell_output, $output);
  
  if($shell_output[0] == "Already up-to-date.")
    echo "Already up-to-date.";
  else
    print_r($shell_output);
  
  echo "<br /><br />";
  
} 
elseif(isset ($_POST['two'])){
  
  echo $op = $mysqli->query("DROP DATABASE c9");
  

} 
elseif(isset ($_POST['three'])){

  exec("cd _db", $a, $b);
  print_r($a);
  
  exec("source webvantage.sql;", $s_op, $op);
  print_r($s_op);
  
} else {
  
  echo "Nothing selected";
  
}

/**
 * Database actions
 * 
 */

$q = "SHOW TABLES";
$op = $mysqli->query($q);
echo "<p style='color: #fff'>List of Tables</p>";
while ($row = mysqli_fetch_array($op)) {
  
   echo $row['Tables_in_c9'] . "<br />";
   
}

?>
  </div>
  </body>
</html>