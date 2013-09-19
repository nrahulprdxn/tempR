<?php 
/*
* footer coomon design
*/ 
?>
</div><!-- End of content-->
  <footer>
  <?php 
   //hidden parameters to identify in Javascript in AJAX requests.
   echo '<input type="hidden" id="today" value="' . date("d-m-Y") .'" />
         <input type="hidden" id="userid" value="' . userid() .'" />
         <input type="hidden" id="baseurl" value="' . get_base() .'" />
         <input type="hidden" id="userrole" value="' . logedin() .'" />'; 
  ?>
 
  <!-- JavaScript at the bottom for fast page loading -->
  <script src="assets/vendor/libs/jquery-ui-1.10.2.min.js"></script>
  <script src="assets/js/jQuery-ajax.js"></script>
  <script src="assets/js/script.js"></script>
  <!-- scripts concatenated and minified via ant build script-->
  <script src="assets/vendor/respond.js"></script>
  </div><!--  End of container  --> 
</footer> 
</body>
</html>