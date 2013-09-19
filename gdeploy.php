<html>
  <head>
    <title>
      Deploy From Git
    </title>
  </head>
  <body>
    <div style="width: 960px; color: #ff4; border: 1px dotted red; margin: 0 auto">
      <form method="post" action="" >
        <input type="submit" value="Check Out" name="one"/>
        <input type="submit" value="TBD" name="two"/>
        <input type="submit" value="TBD" name="three"/>
      </form>
    </div>
  </body>
</html>





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

?>
