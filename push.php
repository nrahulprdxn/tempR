<html>
  <head>
    
  </head>
</html>





<?php 
/**
* Git Pull
*/

exec('git pull origin master', $shell_output, $output);
print_r($shell_output);
print_r($output);

?>
