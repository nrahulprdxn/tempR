<?php require_once('../connector/connector.php');

 /*
  * The template for sidebar contains login and add user forms.
  * 
  * contains all uniq designs for home page
  */
 ?>
  <div class="sidebar">
    <div class="login">
      <?php // calls login form  
        login_form();   
      ?>
    </div> 
      <?php // calls logout button
        logingout(); 
      ?>

    <div class="add_user">
      <?php // calls add new user form
        new_user(); 
      ?>
    </div> 
  </div>
 
 
