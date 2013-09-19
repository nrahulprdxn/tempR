<?php require_once('../connector/connector.php');
/*
* The template for Admins results panel 
*/

 getheader();  
echo 'Hey brother, your site id is' . $_GET['sid'];

$a = in_select('sitelog', 'anselected',"site_Id = $_GET[sid]"); 

while($ro = mysqli_fetch_array($a)) :        
                 
  $alanysts = explode(',', $ro['anselected']);
  
for($i = 0; $i < (count($alanysts)); $i++){    
    
    $b = in_select('resultlog', '*',"site_Id = $_GET[sid] && u_Id = $alanysts[$i]"); 
    while($r = mysqli_fetch_array($b)) : 
      print_r($r);
      echo '<br />';
      
      if($r['status'] == '-1'){
        
        echo $mcs = $r['mcs'];
        
      }
      
      
      
      
      
    endwhile;     
    
  }
                                        
endwhile;
 ?>


<?php getfooter(); ?>