<?php require_once('../connector/connector.php');
/*
 * Template for admin database transactions via ajax
 */

 // Getting all required parameters
 $pur = $_POST['pur'];                  // Desides the scope of request
 $u_Id = $_POST['u_Id'];                
 $result_Id = $_POST['result_Id'];    
 $sitename = $_POST['sitename']; 
 $mcarray = $_POST['mcselected']; 
 $note = $_POST['note']; 
 echo $resultdate = (string)strtotime($_POST['resultdate']); 
 $crossarray = $_POST['crosssite']; 
 $status = $_POST['status']; 
 $astatus = $_POST['astatus'];
 $mcselected = '';
 $crosssite = $crossarray;
 
 // Creates a comma separated sting from a array.
 for( $i=0; $i < count($mcarray); $i++ ) {
   
   $mcselected .= $mcarray[$i];
   if ($i < (count($mcarray)-1)){
     $mcselected .= ',';
   }
   
 }
 
 // Add new site to database ("Rank my site")
 if( $pur == 'addNewReq' ) { 
   
   add_site_logs(intval($u_Id), $result_Id, $sitename, $mcselected, $note, $resultdate, $crosssite, $status, $astatus);
   newClientEnquiryMail(); 
    
 }

 // Deleting a site.
 if( $pur == 'deleterequest' ) {
   
   $table = $_POST['table'];
     $column = $_POST['column'];
       $vals = $_POST['value'];
         $where = 'site_Id=' . $_POST['where'];
  in_update($table, $column, $vals, $where);

 } 
 
 // Updating status of site for admin in sitelist.
 if( $pur == 'updatestep' ) {   
   
   $table = $_POST['table'];
     $column = $_POST['column'];
       $vals = $_POST['value'];
         $where = 'site_Id=' . $_POST['where'];
  in_update($table, $column, $vals, $where);
  
  if($vals == 'b'){
    
    $analysts = $_POST['analysts'];
        
    for($i=0; $i<count($analysts); $i++) {
      
      $tab = $_POST['table2'];
      $col = 'u_Id, site_Id, mc';
      $val = "$analysts[$i], $_POST[where], '$_POST[mcs]'";
    
    in_update('sitelog', 'status', 'Approved', "site_Id = $_POST[where]");
    
    }
  }else
  if($vals == 'c') {
    
      $analysts = $_POST['analysts'];  
      $mcs = $_POST['mcs'];
      $points = '';
      $anlist = '';
      $mc = explode(',', $mcs);
      for($j = 0; $j < count($mc); $j++){
        $points .= '0,';
      }
      
      for($i = 0; $i < count($analysts); $i++) {
        
        $tab = $_POST['table2'];
        $col = 'u_Id, site_Id, mc, points, status';       
        $val = "$analysts[$i], $_POST[where], '$mcs', '$points', '1'";        
        $anlist .= $analysts[$i] . ',';
        
        echo $resultLogId = in_insert( $tab, $col, $val );
    
      }
      
      in_update('sitelog', 'anselected', $anlist, "site_Id = $_POST[where]");
    
  }else
  if($vals == 'd'){
    
    $analysts = $_POST['analysts'];
    $index = $_POST['indexl'];        

    $Date = strtotime(trim($_POST[deadline]));
      in_insert('results', 'rel_Id, sitename, lastdate, status', "$index, '$_POST[sitename]', $Date,'1'" );  
      in_update('sitelog', 'status', 'Progress', "site_Id = $_POST[where]");
      in_update('sitelog', 'lastdate', $Date, "site_Id = $_POST[where]");
    
  }
   
 }
 
 // Setting admin's data (sitelists) on pageload.
 if( $pur == 'chkadminstatus' ) {
   
   $x = intval($_POST['where']);
   $s = in_select('sitelog', 'result_Id', "site_Id = $x");
    while($rows = mysqli_fetch_array($s)):
      echo $rows['result_Id'];
    endwhile; 
   
 } 
 
  // Setting analyst's data (sitelists) on pageload.
 if( $pur == 'chkanalystatus' ) {
   
   $x = intval($_POST['where']);
   $s = in_select('sitelog', 'result_Id', "site_Id = $x");
    while($rows = mysqli_fetch_array($s)):
      echo $rows['result_Id'];
    endwhile; 
   
 } 
 
  // Updating status of site for analysts in sitelist.
  if( $pur == 'updateanstep' ) {
    
    
    $stat = (intval($_POST['stat']) + 1);      
    // Setting recommentation in datatable.
    if($stat == -1){        
      in_update($_POST['table'], $_POST['column2'], $_POST['recom'], "rel_Id = $_POST[where]");
    }else{
      in_update($_POST['table'], $_POST['column'], $_POST['value'], "rel_Id = $_POST[where]");      
    }
    in_update($_POST['table'], 'status ', $stat, "rel_Id = $_POST[where]");
   
 } 
  
 ?>