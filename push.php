#!php -q
<?php 
/**
* Git Pull
*/
 
   echo exec('git pull origin master'); 

   echo shell_exec('git status');
?>
