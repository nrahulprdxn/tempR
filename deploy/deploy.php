<?php
$host = getenv("IP");            // Set host name of database
$username = 'nrahulprdxn';      // Set database username
$password = '';                // Set database password
$dbname = 'c9';               // Set database name
$dbpre = 'in';               // Set table prefix
?>
<html>
  <head>
    <title>
      Deploy From Git
    </title>
    <style>
      .cf:before,
      .cf:after {
        content: " ";
        display: table;
      }

      .cf:after { clear: both; }

      .cf { *zoom: 1; }

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
          margin: 0 35px;
          font-size: 20px;
        }
        p{   
          margin: 5px 35px;
          font-size: 18px;
        }
        ul{
          width: 300px;
          float: left;
        }
        li{
          list-style: none;
        }
        .view-table{
          width: 60px;
          margin: 0 0 0 20px;
          float: left;
        }
    </style>
  </head>
  <body style="background-color: #000;">
    <div style="width: 960px; color: #ff4; border: 1px dotted red; margin: 0 auto">
      <form method="post" action="" >
        <lable name="cloneurl">Enter git url </lable>
        <input name="urlclone" type="text" />
        <input type="submit" value="Clone" name="cloneme"/>
        <input type="submit" value="Check Out" name="pull"/>
        <input type="submit" value="Drop Database" name="dropdb"/>
        <input type="submit" value="Import SQL" name="impdb"/>
         <input type="submit" value="Export SQL" name="expdb"/>
      </form>
<?php 
/**
* Git Pull
*/

$mysqli = new mysqli($host, $username, $password, $dbname);

if(isset ($_POST['cloneme'])){
  
  exec("git clone " . $_POST['urlclone'], $shell_output, $output);
  print_r($shell_output);

}elseif(isset ($_POST['pull'])){
  
  
  exec('cd ..; git pull', $shell_output, $output);
  
  if($shell_output[0] == "Already up-to-date.")
    echo "<p class='status'>Already up-to-date.</p>";
  else
    print_r($shell_output);

  
} 
elseif(isset ($_POST['dropdb'])){
  
  $mysqli->query("DROP DATABASE c9");
  $mysqli->query("CREATE DATABASE c9");

} 
elseif(isset ($_POST['impdb'])){

  exec("cd _db; mysql-ctl cli; use c9; source webvantage.sql; exit;", $as);
  print_r($as);
    
}elseif(isset ($_POST['impdb'])){

  exec("cd _db", $a, $b);  
  print_r($a);
  
  //exec("source webvantage.sql;", $s_op, $op);
  //print_r($s_op);
  
}elseif(isset ($_POST['expdb'])){

  
}
else {
  
  echo "<p class='status'>Nothing selected</p>";
  
}

/**
 * Database actions
 * 
 */

$q = "SHOW TABLES";
$op = $mysqli->query($q);
echo "<div class='table-list cf'>
  <p style='color: #fff'>List of Tables</p>
      <div>";
while ($row = mysqli_fetch_array($op)) {
  
   echo $row['Tables_in_c9'];
   

  echo '<div class="view-table">';

  echo $qu = "SELECT * FROM " . $row['Tables_in_c9'];
  $results = $mysqli->query($qu);
  echo '<table>';
  if(count($results) > 0){
  	foreach ( mysqli_fetch_array($results) as $index => $result) {
      if($index == 0){
     echo '<tr class="dbtable_wrapper">';
    
      foreach ($result as $key => $value) {
        
        echo '<td class="user_id">'. $key .'</td>';
        
      }
      echo '</tr>';
    }
      echo '<tr class="dbtable_wrapper">';
    
      foreach ($result as $key => $value) {
        
        echo '<td class="user_id">' . $value . '</td>';
        
      }
      echo '</tr>';
    }
  }
  else{
    echo '<tr class="dbtable_wrapper"><td class="user_id">No data</td></tr>';
  }
   echo '</table>';
}
echo '</div>
</div></div>';
?>
  </div>
  </body>
</html>