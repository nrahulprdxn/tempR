<?php require_once('../connector/connector.php');
/*
* The template for users admin panel 
*/

 getheader();  
?>
    
<div id="rank" >
  <h2> Rank My Site </h2> 
    <?php 
      $b = in_select('measurementcriteria');
      $c = in_select('sitelog', 'sitename','u_Id != "'. userid() .'"');
    ?>
  <div id="request" >
    Site URL: 
    <input type="text" id="new_site_url" /> <br />
    Measurement Criteria: 
    <select multiple id="new_site_mcs">
    <?php 
    
      // Binding MCs from db to dropdown   
      while($rows = mysqli_fetch_array($b)) :   ?> 
        <option>
          <?php echo $rows['mcName']; ?>
        </option>
    <?php endwhile; ?>                           
    </select>
    
    <label for="compare">
      <input name="compare" id="compare" type="checkbox" />
      Want to compare with another site?
    </label>
    <span id="comparison">
      Compare With: 
      <select multiple id="new_site_comparitors">
      <?php 
      
      // Binding sites from db to dropdown 
        while($ro = mysqli_fetch_array($c)) : ?> 
          <option>
            <?php echo $ro['sitename']; ?>
          </option>
      <?php endwhile; ?>
      </select>
      If not in list: <input type="text" id="new_site_custom_mcs" />
    </span>
    <button id="new_site_submit"> OK </button>   
  </div>
</div>
<?php 

// Query manipulation for status view.
$apend = ' AND status!="Deactive"';
if(isset ($_POST['ALL']))
  $apend = '';
if(isset ($_POST['Request']))
  $apend = ' AND status!="Deactive" AND status = "Request"';
if(isset ($_POST['Approved']))
  $apend = ' AND status!="Deactive" AND status = "Approved"';
if(isset ($_POST['Progress']))
  $apend = ' AND status!="Deactive" AND status = "Progress"';
if(isset ($_POST['Final']))
  $apend = ' AND status!="Deactive" AND status = "Final"';
if(isset ($_POST['Closed']))
  $apend = ' AND status!="Deactive" AND status = "Closed"';
if(isset ($_POST['Trashed']))
  $apend = ' AND status = "Deactive"';

 $a = in_select('sitelog', '*', 'u_Id = ' . userid() . $apend); ?>
<div id="see" >
  <h2>
    <?php if($a->num_rows != '0') {
            echo 'See My Results ';         
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
   ?>
  <div id="<?php echo $row['site_Id'] ?>" class="results <?php echo $row['status'] ?>">

<!--<input type="checkbox" />-->
<button class="delete" > DELETE </button>

    <?php 
          echo "Site Name:  $row[sitename] <br />
               <p>Details</p> 
               <span class='collaps'>
               Application Date: " . date('D, d M Y', $row['resultdate']) . "<br />
               Work Status:  $row[status] <br />
               Measurement Criterias: $row[mcselected] <br />";
          if($row['crosssite'] != '')
            echo "Compare with: $row[crosssite] </span>";  
           ?>
  </div>
 <?php endwhile; 
      }
            else     
              echo 'No Results available'; ?>   
</div>

<?php getfooter(); ?>