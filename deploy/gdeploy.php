<?php
  
exec('cd var/www/test/tempR');  
//exec('git pull origin master', $shell_output, $output);
system('echo "prdxn2012" | sudo -u user -S git pull origin master', $retval);

echo $retval;

?>
  