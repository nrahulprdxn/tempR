<html>
  <head>
    <title>
      Deploy From Git
    </title>
  </head>
  <body>
    <div>
      <form>
        <input type="submit" value="Check Out"/>
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

?>
