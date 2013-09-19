<?php 
    header('location:design/index.php'); 
    die();
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<script type="text/javascript">
var tolnum;
function myCaptcha() {
var leftnum =[5, 10, 15, 20];
var rightnum =[2, 4, 6, 8];

var leftnum = Math.floor(Math.random()*11);
var rightnum = Math.floor(Math.random()*11);


 tolnum = leftnum + rightnum ;
 // alert(tolnum);
document.getElementById("sh").innerHTML = leftnum + " + " + rightnum;

}

function validate() {
    var captchanow = document.getElementById("captcha");
    captchanow = parseInt(captchanow.value);
    // alert(typeof(parseInt(captchanow.value)));
    if (captchanow == "") {
    alert("Please enter a captcha");    
        return false;
    }
    else if(captchanow != tolnum) {
        alert("wrong captcha entered"); 
        return false;
    }
    else {
        //form.submit
        alert('Well done');
    }
    return true;

}

</script>
</head>

<body onload="myCaptcha()">

<form action="" method="post" onsubmit="return false;">
  <p>Captcha :
  <input name="captcha" type="text" id="captcha" value="" />

  <label id="sh" value=""></label></p>
  <p>
    <input type="submit" name="button" id="button" value="Submit" onclick="validate()"/>
  </p>
</form>
</body>
</html>