<html>
<head>
<title> Home | Demo </title>
</head>  
<body>
<div>Test</div>
<div>one more div structure!</div>
<div>third div structure!</div>
</body>
</html>

<?php

$host = 'localhost';            // Set host name of database
$username = 'root';      // Set database username
$password = 'prdxn2012';                // Set database password
$dbname = 'test';               // Set database name
$dbpre = 'in';               // Set table prefix

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

?>