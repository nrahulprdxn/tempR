<?php require_once( 'connector.php' );
/*
* Function file contains all main functions used across the site.
* 
*/

$dbpre = $dbpre .'_';

/*
* this will include header.php
*/ 
function getheader() {
    
  include_once "header.php"; 

}

/*
* this will include footer.php
*/ 
function getfooter() {
    
  include_once "footer.php"; 

}

/*
* this will include sidbar.php
*/ 
function getsidebar( $bar = '' ) {
    
  if($bar == '')
    include_once "sidebar.php"; 
  elseif($bar == 'left')
    include_once "sidebar-left.php"; 
  elseif($bar == 'right')
    include_once "sidebar-right.php"; 
  
}

/*  
* Database query functions
*/

/*
* Fetch data from data table in array form
* 
* variable 1 = table name
* variable 2 = column name default -> all 
* variable 3 = where clause
*/   
function in_select( $dbt, $column = '*', $where = '' ) {
  
  global $mysqli, $dbpre;
  $q = 'SELECT '. $column .' FROM '. $dbpre . $dbt;
  if ( $where != '' )
    $q .= ' WHERE '. $where;  
 
   return $result = $mysqli->query( $q );
  
}
  
/*
* Upadate particular data table
* 
* variable 1 = table name
* variable 2 = string of columns to be update comma seperated (,)
* variable 3 = string of updated values comma seperated (,)
* variable 4 = where clause
*/
function in_update( $table, $column, $val, $where ) {
    
  global $mysqli, $dbpre; 
  $q = "UPDATE $dbpre$table  SET $column = '$val' WHERE $where";
  $mysqli->query( $q );

}
  
/*
* Insert new entity to particular table
* 
* variable 1 = table name
* variable 2 = string of column comma seperated (,) 
* variable 3 = dtring of values to be insert comma seperated (,)
*/
function in_insert( $table, $column, $vals ) {
    
  global $mysqli, $dbpre;
  $q = "INSERT into $dbpre$table ($column) VALUES ($vals)";
  $mysqli->query( $q );
  return $mysqli->insert_id;

}
  
/*
* Deleting particular entry
* 
* variable 1 = table name
* variable 2 = where clause
*/  
function in_delete( $table, $where ) {
    
  global $mysqli, $dbpre;
  $q = "DELETE FROM $table WHERE $where";
  $mysqli1->query( $q );

}
  
/*
* Creating default super admin at the time of installation
*/ 
function create_user( $fname, $lname, $email, $password, $cpass, $address, $role, $status ) {
    
  global $mysqli, $dbpre;
  $sla = slant();  // Random text
  $password = $sla.$password;
  $cpass = $sla.$cpass;
  $user = "SELECT u_id FROM ". $dbpre ."Users where email = '$email'";
  $reply = mysqli_fetch_array($mysqli->query($user));
  
  // If email id does nor exists only then we allow new user to be added
  if($reply['u_id'] == '') { 
      
    // Superadmin cannot be add manually and more than once
    if($role == 'superadmin') {
    $superadmin = "SELECT * FROM ". $dbpre ."Users";
        $re = $mysqli->query($superadmin);           
        if($re->num_rows == '0') {
          $nq = "INSERT INTO ". $dbpre ."Users ( FirstName, LastName, email, password, Address, role, slant, status )
          VALUES ( '$fname','$lname', '$email', '". md5($password) ."', '$address', '$role', '$sla', '$status' )";
        $mysqli->query($nq);
       }
     } else { 
       if($password == $cpass) {
         $nq = 'INSERT INTO '. $dbpre .'Users (FirstName, LastName, email, password, Address, role, slant, status)
         VALUES ("'. $fname .'","'. $lname .'","'. $email .'","'. md5($password) .'","'. $address .'","'. $role.'","'. $sla .'","'. $status .'")';
         $mysqli->query( $nq ); 
         return 'User Added'; //$last_id = $mysqli->insert_id;
       } else 
         return 'Match password and confirm password';         
     }     
  } else
    return 'User Exists'; 
 
}  
   
/*
* function to check if provided user is registered or not
* 
* Returns role of user
* for internal use 
*/
function is_user( $uName, $pWord ) {
    
  global $mysqli, $dbpre;
  $slant = "SELECT slant FROM ". $dbpre ."Users where email = '". $uName ."'";
  $sreply = mysqli_fetch_array($mysqli->query($slant));
  $sreply['slant'];
  $pWord = $sreply['slant'].$pWord;
  $user = "SELECT * FROM ". $dbpre ."Users where email = '". $uName ."' AND password = '". md5($pWord) ."'";
  $reply = mysqli_fetch_array($mysqli->query($user));
  return $reply;
  
}
  
/*
* User log in using session
*/
function login() {   
    
  if(isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $ans = is_user($user, $pass);
    if(!isset($_SESSION['user'])) {
      $_SESSION['user'] = $ans['role'];
      $_SESSION['info'] = $ans['FirstName'];
      $_SESSION['id'] = $ans['u_Id'];
    }
    if(!isset ($_COOKIE["userlogin"]))
      setcookie("userlogin", $ans, time() + 3600);
  }     
  unset($_POST['login']);  
  
}
  
/*
* Generates login form 
* 
* login functionality is defined in login function
* Returns user role
*
* variable = text to display as a form heading  
*/
function login_form( $title = 'User Login' ) {
    
  if(logedin() == 'guest') {
    echo '<h2>'. $title .'</h2>
      <form id="login" name="login" method="post" action="">
        <input type="text" name="username" placeholder="Email" />
        <input type="password" name="password" placeholder="Password" />         
        <input type="submit" name="login" value="Login!">
      </form>';
  if(isset ($_POST['login']))
    login();
  }  
  return logedin();
  
}

/*
* Manage user status/role
*/ 
function logedin() {

  if(isset($_SESSION['user'])) {
    return $_SESSION['user'];
  } else 
    return 'guest';
    
}

/*
* Manage users name 
*/
function useris() {
    
  if(isset($_SESSION['info'])) {
    return $_SESSION['info'];
  } else 
    return 'guest';
    
}

/*
* Manage users id 
*/
function userid() {
    
  if(isset($_SESSION['id'])) {
    return $_SESSION['id'];
  } else 
      return '';
    
}

/*
* log out function
*/
function logout() {
    
  session_destroy();
    
}

/*
* Generates logout layout 
*/
function logingout() {
    
  if(logedin() != 'guest') {
    echo '<form id="login" name="login" method="post" action="">
           <input type="submit" name="logout" value="Logout!">
         </form>';
    if(isset($_POST['logout'])) {
      logout();
    }  
  }    
    
}

/*
* New user form
* 
* Create new user layout 
*
* variable = text to display as a form heading  
*/
function new_user( $title = 'Add User' ) { 
    
  $User = 'User';
  echo "<h2> $title </h2>".
  '<form id="adduser" name="adduser" method="post" action="" >
    <input type="text" name="fname" placeholder="First Name" /><br>
    <input type="text" name="lname" placeholder="Last Name" /> <br>
    <input type="text" name="email" placeholder="Email" /><br>
    <input type="password" name="password" placeholder="Password" /><br>
    <input type="password" name="cpassword" placeholder="Confirm Password" /><br>
    <!--<input type="text" name="addr" placeholder="Website" /><br>-->';
          if(logedin() == 'Admin' || logedin() == 'superadmin')
              echo '<select name="user">
                      <option name="admin" > Admin </option>
                      <option name="analyst"> Analyst </option>
                      <option name="user"> User </option>
                      <option name="editor"> Editor </option>
                    </select>';
    echo '<input type="submit" name="addUser" value="Submit">
  </form>'; 
  if(isset ($_POST['user']))
    $User = $_POST['user'];
  if(isset ($_POST['addUser'])) 
    echo create_user($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['password'], $_POST['cpassword'], $_POST['addr'],  $User, 'active'); 
  unset($_POST['addUser']);  
  
}

/*
 * Change password
 * 
 * variable 1 = Title for form 
 * variable 2 = Successes massege
 * variable 3 = error massege
 */
function change_pass( $title = 'Change Password', $success = 'Password changed', $error = 'Sorry' ) {
  
  echo "
        <form name='changepas' method='post' action='' >         
          <input type='text' name='cpass' placeholder='Current password' />
          <input type='text' name='npass' placeholder='New password' />
          <input type='submit' name='change' value='Submit' />
        </form>
        ";
  
        if(isset ($_POST['change'])) {             
   
          $reply = in_select( 'users', 'password, slant', "u_Id = ". userid());
          
          while($ro = mysqli_fetch_array($reply)) :
            
            $val = md5($ro['slant']. $_POST['npass']);
          
            if(check_pass($ro['password'], $ro['slant']. $_POST['cpass'])){
              
               in_update( 'users', 'password', $val, "u_Id = ". userid()); 
               return $success;
               
            }              
            else
               return $error;
            
          endwhile;
          
          }
    
    unset ($_POST['change']);
  
}

/*
 * checkes two entity (direct with md5 pattern)
 * 
 * update password IINTERNAL
 */
function check_pass($dpass, $inpass) {
  
  if ($dpass == md5($inpass))
    return true;
  else 
    return false;
                                                             
}

/*
* Slant generator
*/
function slant() {
    
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $randstring = '';
  for ($i = 0; $i < 10; $i++) {
    $randstring = $characters[rand(0, strlen($characters))].$characters[rand(0, strlen($characters))].$characters[rand(0, strlen($characters))];
  }
  return $randstring;
    
}

/*
* Defines base url of site without echo 
*/
function get_base($in = '') {
    
  global $baseurl;
  return $baseurl . "$in";
    
}

/*
* Defines base url of site with echo 
*/
function the_base($in = '') {
    
  global $baseurl;
  echo $baseurl . "$in";
    
}

/*
* Defines base url for admin directory without echo 
*/
function get_admin_url($in = '') {
    
  global $baseurl;
  return $baseurl . "admin/$in";
    
}

/*
* Defines base url for admin directory with echo 
*/
function the_admin_url($in = '') {
    
  global $baseurl;
  echo $baseurl . "admin/$in";
    
}

/*
* Defines base url for themes directory without echo 
*/
function get_theme_url($in = '') {
    
  global $baseurl;
  return $baseurl . "design/$in";
    
}

/*
* Defines base url for themes directory with echo 
*/
function the_theme_url($in = '') {
    
  global $baseurl;
  echo $baseurl . "design/$in";
    
}

/*
* setting user journey as per role 
* 
* variable 1 = type/part of template (designIndex/adminIndex)
*/
function userpath( $section ) {   
  
  // Analyse gets redirect to Analyse page at sign in
  if(logedin() == 'Analyst' && $section == 'designIndex')
    header('Location:'. get_base() .'admin/Analyst.php');
  
  // Admin or Superadmin gets redirect to Admins page at sign in
  if((logedin() == 'Admin' || logedin() == 'superadmin') && $section == 'designIndex')
    header('Location:'. get_base() .'admin/index.php');  
  
  // User gets redirect to Users page at sign in
  if((logedin() == 'User') && $section == 'designIndex')
    header('Location:'. get_base() .'admin/user.php');
 
  // Guest always lies in main design page at sign in
  if(logedin() == 'guest' && $section == 'adminIndex')
    header('Location:'. get_base() .'design/index.php');
 
}

/*
* Database installation function
* 
* variable 1 = true/false => create/delete table.
* variable 2* = true/false => creates demo entries (Do not use after development)
* * Use true only once or it will replecate same entries in tables.
*/
function install( $data, $first ) {      
  
  global $mysqli, $dbpre;  
  $d = 'CREATE TABLE IF NOT EXISTS '. $dbpre;
  $a = 'DROP TABLE '. $dbpre;
  $t = '';  
  
  if($data) {
    
    $q = $d .'Users
      (
        u_Id int NOT NULL auto_increment,
        FirstName varchar(255) NOT NULL,
        LastName varchar(255) NOT NULL,
        email varchar(255) NOT NULL,
        password varchar(255) NOT NULL,
        Address varchar(255),
        role varchar(255) NOT NULL,
        slant varchar(255) NOT NULL,  
        status varchar(25) NOT NULL,
        PRIMARY KEY (u_Id)
      )';
    $u = $d .'Sitelog  
      (
        site_Id int NOT NULL auto_increment,
        u_Id int NOT NULL,
        result_Id varchar(50),
        sitename varchar(255) NOT NULL,
        mcselected varchar(255) NOT NULL,
        anselected varchar(255),
        note varchar(255) NOT NULL,     
        resultdate varchar(50),
        lastdate varchar(50),
        crosssite varchar(255),
        status varchar(25) NOT NULL,
        adminstatus varchar(25) NOT NULL,
        PRIMARY KEY (site_Id)
       )';
    $e = $d .'Results
      (
        result_Id int NOT NULL auto_increment,
        resultdata varchar(255) NOT NULL,
        rel_Id int,
        sitename varchar(255) NOT NULL,
        lastdate varchar(50),  
        status varchar(25) NOT NULL,
        PRIMARY KEY (result_Id)
      )';
    $r = $d .'Measurementcriteria
      (
        mc_Id int NOT NULL auto_increment,
        mcName varchar(255) NOT NULL,
        mcDiscription varchar(255) NOT NULL,            
        PRIMARY KEY (mc_Id)  
      )';
    $y = $d .'Recommentations
      (
        re_Id int NOT NULL auto_increment,
        reCase varchar(255) NOT NULL,
        mc_Id varchar(255) NOT NULL,
        reDescription varchar(255) NOT NULL,            
        PRIMARY KEY (re_Id)           
      )';   
    $z = $d .'Resultlog
      (
        rel_Id int NOT NULL auto_increment,
        u_Id int,          
        site_Id int,
        mc varchar(255),
        points varchar(255),
        recomentations varchar(255),
        outoff int,
        status varchar(255),
        PRIMARY KEY (rel_Id)           
      )';   

    }        
    else {
      
      $q = $a .'Users';
      $u = $a .'Sitelog';
      $e = $a .'Measurementcriteria';
      $r = $a .'Recommentations';
      $y = $a .'Results';
      $z = $a .'Resultlog';
      
    }

    // Firing query to instal or uninstal.
    $mysqli->query( $q ); 
    $mysqli->query( $u ); 
    $mysqli->query( $e ); 
    $mysqli->query( $r ); 
    $mysqli->query( $y ); 
    $mysqli->query( $z ); 
  
  if($data){  
    temp_demo( $first );
  }
    
}

function temp_demo( $first ) {
  if( $first ){
  
  // Creating demo users one of each type with all four roles on instalment.
  create_user( 'super', 'admin', 's@a.com', 'admin', 'admin', '', 'superadmin', 'active' );
    create_user( 'demo', 'admin', 'ad@a.com', 'admin', 'admin', '', 'Admin', 'active' );
      create_user( 'demo', 'analyst', 'an@a.com', 'analyst', 'analyst', '', 'Analyst', 'active' );
        create_user( 'demo', 'user', 'u@a.com', 'user', 'user', '', 'User', 'active' );
          create_user( 'demo', 'editor', 'e@a.com', 'editor', 'editor', '', 'Editor', 'active' );
  
  // Creating 6 demo measurement criteria 
  add_criteria( 'MC-1', 'DEMO MC-1' );
    add_criteria( 'MC-2', 'DEMO MC-2' );
      add_criteria( 'MC-3', 'DEMO MC-3' );
        add_criteria( 'MC-4', 'DEMO MC-4' );
          add_criteria( 'MC-5', 'DEMO MC-5' );
            add_criteria( 'MC-6', 'DEMO MC-6' );
  
  }
  
}

function startup() {
  
  install( true, false );
  
}

function addDemos() {
  
  install( true, true );
  
}

function shutdown() {
  
  install( false, false );
  
}

/*
 * Function to add new request for site from user dash-board.
 * 
 * Steps assumed: Requested -> Approved -> Progress -> Final -> Closed // Trashed.
 */
function add_site_logs( $u_Id, $result_Id, $sitename, $mcselected, $note, $resultdate, $crosssite, $status, $astatus ) {
  
  in_insert( /*var 1*/ 'sitelog',
             /*var 2*/ 'u_Id, result_Id, sitename, mcselected, note, resultdate, crosssite, status, adminstatus', 
             /*var 3*/ "$u_Id, '$result_Id', '$sitename', '$mcselected', '$note', '$resultdate', '$crosssite', '$status','$astatus'" );
  
}

/*
 * Function to add new measuement criterias from user dash-board.
 *   
 */
function add_criteria( $mcname, $mcdescription ) {
  
  in_insert( 'measurementcriteria', 'mcName,mcDiscription',"'$mcname','$mcdescription'" );
  
}

/*
 * Function to check if all listed analists have compleated the assingment
 * Internal use only
 * 
 */
function check_analists_complesion($uid, $sid) {
      
    $d = in_select('resultlog', 'u_Id, status', "u_Id = $uid && site_Id = $sid");
    while($r = mysqli_fetch_array($d)) :
       $stat = $r['status'];
       if($stat == '-1'){
         return true;
       break;       
       }else
         return false;
    endwhile;   
  
}

/*
 * Function to use in code file to check analysts testing complesion status
 * 
 */
function check_analists_complesions($uid, $sid){
  
      if(check_analists_complesion($uid, $sid)){
      echo 'Testing Done By: ';
      $h = in_select('users', 'FirstName, LastName', "u_Id = $uid");

      while($z = mysqli_fetch_array($h)) :
         echo $z['FirstName'] . ' ' . $z['LastName'];
      endwhile;
      echo '<br />';
      return true;
    }else {
      echo 'Testing Remaining By: ';
      $v = in_select('users', 'FirstName, LastName', "u_Id = $uid");

      while($x = mysqli_fetch_array($v)) :
         echo $x['FirstName'] . ' ' . $x['LastName'];
      endwhile;
      echo '<br />';
      return false;
    }  
  
}


/**/
function upload_file(){}

/**/
function logo(){}

/**/
function the_logo(){}

/**/
function get_logo(){}
?> 