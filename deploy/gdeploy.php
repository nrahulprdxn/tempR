<?php
  
      echo '<form method="post" action="" >       
        <input type="submit" value="Check Out" name="pull"/>      
      </form>';      


  if(isset ($_POST['pull'])){
    
  exec('cd ..; git pull', $shell_output, $output);
  
  if($shell_output[0] == "Already up-to-date.")
    
    echo "<p class='status'>Already up-to-date.</p>";
  
  else
    var_dumb($shell_output);
    
  }
?>
  