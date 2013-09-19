<html>
  <head>
    <title>
      Deploy From Git
    </title>
  </head>
  <body>
    <div>
      <form method="post" action="">
        <input type="submit" value="Check Out" name="one"/>
        <input type="submit" value="Check Out" name="two"/>
        <input type="submit" value="Check Out" name="three"/>
      </form>
    </div>
  </body>
</html>





<?php 
/**
* Git Pull
*/

exec('git pull origin master', $shell_output, $output);
print_r($shell_output);
print_r($output);
echo $_POST;

?>
