#!php -q
<?php 
/**
* Git Pull
*/
 
   echo shell_exec('git pull origin master') . "<br /><br />"; 

   echo shell_exec('git status');
?>
