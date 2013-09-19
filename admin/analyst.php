<?php require_once('../connector/connector.php');
/*
* The template for analysts admin panel 
*/
 
 getheader(); 
 
 // Getting basic data from Resultlog data table.
  $a = in_select('resultlog', '*', "u_Id=  ". userid());   
  $i = 1;
  while($rows = mysqli_fetch_array($a)) :     
  ?>

 <div id="<?php echo $i; ?>" class="results In Progress">
 <?php
 
   // Getting data from Sitelog datatable to get site name for each block.
      $b = in_select('sitelog', '*', "site_Id = $rows[site_Id]");
      while($row = mysqli_fetch_array($b)) :
        
        echo 'Site Name: "' . $row['sitename'] . '"<br />';
      
        // Getting data from users table to display user name who requested the test.
        $c = in_select('users', '*', "u_Id = $row[u_Id]");        
         while($ro = mysqli_fetch_array($c)) : 
           
           echo 'User: ' . $ro['FirstName'] . '<br />';
         
         endwhile;
        
         echo 'Final date: ' . date('D, d M Y', $row['lastdate']) . '<br />';
         
      endwhile;
      
      // Exploding number of criterias to score them independently.
      $mcs = explode(',', $rows['mc']);
      
      // Exploding Points given.
      $points = explode(',', $rows['points']);
      
      echo '<br /><ul>';
      for($j = 0; $j < count($mcs); $j++) {
        
        $k = $j+1;
        echo "<li class='an-step an-step-$k'>Measurement Criteria $k: " . $mcs[$j] . '<br />';
        
        // Getting description of MC from measurement criteria table for perticular MC.
        $d = in_select('measurementcriteria', 'mcDiscription', "mcName = '" . trim($mcs[$j]) . "'");
        while( $r = mysqli_fetch_array($d) ) : 
          
          echo 'Discription: ' . $r['mcDiscription'] . '<br />';
        
        endwhile;
        
        // Input box to enter score.
        echo '<input type="text" class="score" value="' . $points[$j] . '"/><br /><br /></li>';
       
        }
 ?>
   <li class='an-step an-step-0'>
     Recomentations:<br />
     <textarea></textarea>
   </li>
   <li class='an-step an-step--1'>
     Thank you
   </li>
 </ul>
 <input type="hidden" class="log" value="" />
 <input type="hidden" class="site-id" value="<?php echo $rows['status'] ?>" />
 <input type="hidden" class="rel-Id" value="<?php echo $rows['rel_Id'] ?>" />
   <span class="nextbtn">Next >></span>
 </div>
<?php   
$i++;
endwhile;
getfooter(); ?>