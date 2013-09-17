#!php -q
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

  return shell_exec('git pull origin master');
   

}

echo "<pre>" . pull() ;
echo shell_exec('git status')
. "</pre>";
?>
