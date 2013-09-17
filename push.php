<?php 
/**
* Git Pull
*
* @author Adam Patterson
* http://www.adampatterson.ca/blog/2011/10/diy-simple-staging-server/
*
* Use: echo pull();
*/
 
function pull ( )
{

  shell_exec('git pull');
  return shell_exec('git status');

}

echo "<pre>" . pull() . "</pre>";
?>
