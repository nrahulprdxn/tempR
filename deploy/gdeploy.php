<?php
  
exec('cd var/www/test/tempR');  
exec('git pull origin master 2>&1', $retval, $output);
echo trim(shell_exec('whoami'));
//system('echo "prdxn2012" | sudo -u user -S git pull origin master 2>&1', $retval);

echo $retval;

?>
  