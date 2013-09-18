#!php -q
<?php 
/**
* Git Pull
*/
 
   echo exec('sudo git pull origin master'); 

   echo shell_exec('git status');
?>
