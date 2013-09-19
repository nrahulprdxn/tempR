<?php require_once('../connector/connector.php'); 
/*
* The template for Admins admin panel 
*/
 
   getheader(); 

// Query manipulation for status view.
$apend = '';
if(isset ($_POST['ALL']))
  $apend = '1=1';
if(isset ($_POST['Request']))
  $apend = ' AND status = "Request"';
if(isset ($_POST['Approved']))
  $apend = ' AND status = "Approved"';
if(isset ($_POST['Progress']))
  $apend = ' AND status = "Progress"';
if(isset ($_POST['Final']))
  $apend = ' AND status = "Final"';
if(isset ($_POST['Closed']))
  $apend = ' AND status = "Closed"';
if(isset ($_POST['Trashed']))
  $apend = ' AND status = "Deactive"';

 // Getting results from sitelog table.
 $a = in_select('sitelog', '*', $apend); 
 
 // Getting data from analyst table.
 $b = in_select('users', 'u_Id, FirstName, LastName', "role = 'Analyst'");
 $c = '';
 while($ro = mysqli_fetch_array($b)) :        
                 $c .= "<option value='$ro[u_Id]'>
                          $ro[FirstName] $ro[LastName]
                        </option>";                  
 endwhile;
?>
<div class="main">
<div id="see" >
  <h2>
    <?php if($a->num_rows != '0') {
            echo 'See My Results '; 
            echo '<br /><br />' . check_analists_complesion();
    ?>
  </h2> 
  <form action="" method="post">
    <input type="submit" name="All" id="all" value="All" />
    <input type="submit" name="Request" id="req" value="Requested" />
    <input type="submit" name="Approved" id="app" value="Approved" />
    <input type="submit" name="Progress" id="wip" value="In Progress" />
    <input type="submit" name="Final" id="fin" value="Final stage" />
    <input type="submit" name="Closed" id="clo" value="Closed" />
    <input type="submit" name="Trashed" id="thd" value="Trashed" />
  </form>
   <?php
           while($row = mysqli_fetch_array($a)) :   
           $d = in_select('users', 'FirstName, LastName', "u_Id = $row[u_Id]");
           while($r = mysqli_fetch_array($d)) :
             $uname = $r['FirstName'] . ' ' . $r['LastName'];
           endwhile;
   ?>
  <div id="<?php echo $row['site_Id'] ?>" class="results <?php echo $row['status'] ?>">
    
<!--      <input type="checkbox" />-->
<button class="delete" > DELETE </button>
    
    <?php //print_r($row);
         
          echo " <input type='hidden' class='sitename' value='$row[sitename]' />
                 User Name: $uname <br />                 
                 Site: $row[sitename]<br />
                 Application Date: " . date('D, d M Y', $row['resultdate']) . "
               ";   
                 if($row['lastdate'] != ''){
                   echo '<br />Last Date: ' . date('D, d M Y', $row['lastdate']);
                 }
           echo "<br /><br />
                <p>Details</p>   
                <ul>
                  <li class='step1'> 
                     STEP-1: INQUIRY DETAILS <br />
                     
                     Work Status:  $row[status] <br />
                     Measurement Criterias:<span class='mcs'> $row[mcselected] </span><br />";
            if($row['crosssite'] != '')
               echo "Compared with: $row[crosssite]";

             echo "</li>
               
              <li class='step2'>
                STEP-2: ADD ANALYSTS <br />
                <select multiple class='analyststat'>
                   $c
                </select>
              </li>
               
              <li class='step3'>
                STEP-3: DUE-DATE <br />
                <input type='text' class='duedate' />
              </li>

              <li class='step4'>
                STEP-4: Thank You <br />
                Your Request has been sent to Analysts.
              </li>
            
            </ul>
            <span class='next-step'> next >> </span>
            ";
            // Checking if all analyts have evaluated site completely.
            $analystlist = $row['anselected'];
            $analystlist = explode(',', $analystlist);
            $analysisdone = false;
            for($i = 0; $i < (count($analystlist) - 1); $i++){
              
            $analysisdone = check_analists_complesions($analystlist[$i], $row['site_Id']);            
              
            }
            
            // If all analysts have completed testing records will be visible to admin.
            if($analysisdone){
              echo '<a href="'. get_admin_url() .'results.php?sid='. $row['site_Id'] .'" >Click here for results </a>';
            }else{
              echo 'remaining results';
            }
            
           ?>
  </div>
 <?php         endwhile; 
            }
            else     
              echo 'No Results available'; ?>     
  
</div>
</div>
<?php
 getsidebar(); 
 getfooter();
?>