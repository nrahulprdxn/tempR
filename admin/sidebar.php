<?php require_once('../connector/connector.php');

 /*
  * The template for sidebar contains login and add user forms.
  * 
  * contains all uniq designs for home page
  */
 ?>
  <div class="sidebar">
    

    <div class="add_user">
      <?php 
      $a = in_select('Users', '*');
       while($row = mysqli_fetch_array($a)) {
    
         echo "<div id= '$row[u_Id]' > User:  $row[FirstName]  $row[LastName]  Role: $row[role] </div><br />";      
      }
        // calls add new user form
        new_user(); 
        
        // Change password
        change_pass();
      ?>
    </div> 
  </div>
 
 
