<html>
  <head>
    <title>
      Deploy From Git
    </title>
    <style>
      
        form {
            margin: 40px;
            text-align: center;
        }
        
        input {
          margin: 0 0 0 30px;
          cursor: pointer;
          text-align: center;
        }
        .status{
          
        }
    </style>
  </head>
  <body style="background-color: #000;">
    <div style="width: 960px; color: #ff4; border: 1px dotted red; margin: 0 auto">
      <form method="post" action="" >
        <input type="submit" value="Check Out" name="pull"/>
        <input type="submit" value="Drop Database" name="dropdb"/>
        <input type="submit" value="Import SQL" name="impdb"/>
         <input type="submit" value="Export SQL" name="expdb"/>
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

if(isset ($_POST['pull'])){
  
  exec('git pull origin master', $shell_output, $output);
  
  if($shell_output[0] == "Already up-to-date.")
    echo "<p class='status'>Already up-to-date.</p>";
  else
    print_r($shell_output);
  
  echo "<br /><br />";
  
} 
elseif(isset ($_POST['dropdb'])){
  
  $mysqli->query("DROP DATABASE c9");
  $mysqli->query("CREATE DATABASE c9");

} 
elseif(isset ($_POST['impdb'])){

  exec("cd _db");
  exec("mysql-ctl cli");
  exec("use c9;");
  exec("source webvantage.sql;", $as);
  exec("exit;");
  print_r($as);
  
  //exec("source webvantage.sql;", $s_op, $op);
  //print_r($s_op);
  
}elseif(isset ($_POST['impdb'])){

  exec("cd _db", $a, $b);  
  print_r($a);
  
  //exec("source webvantage.sql;", $s_op, $op);
  //print_r($s_op);
  
}elseif(isset ($_POST['expdb'])){

  
}
else {
  
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