<?php
  
exec('cd var/www/test/tempR');  
exec('git pull origin master', $shell_output, $output);
  
?>
  