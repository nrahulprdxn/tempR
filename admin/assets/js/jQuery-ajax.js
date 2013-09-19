/*
 * The script for ajax requests
 *
 */
$(document).ready(function() { 
  
  /*----------------GLOBAL-------------------*/
  
  // Setting base url for whole ajax file.
  var $g = $('#baseurl').val(),
      $user = $('#userrole').val();
    
  /*----------------USER-------------------*/
  
  // Code to add new site (Rank my site) Request to admin (Role: USER)
  $('#new_site_submit').click(function(){
    
    // Getting all values from user
    var a = $('#new_site_url').val(), 
        b = $('#new_site_mcs').val(), 
        c = $('#new_site_comparitors').val(),
        d = $('#new_site_custom_mcs').val(),
        e = $('#today').val(),
        f = $('#userid').val(),
        j = '';
    if(c != null){
      for(var i = 0; i < c.length; i++){
        j += c[i];
      }
    }
     
    if(c != null && d != '')
      c =  j + ',' + d;
    
    if(c == null && d != '')
      c = d;
    
    if(c != null && d == '')
      c = j;
    
    // Setting ajax data
    var h = { 
              pur: 'addNewReq',
              u_Id: f,
              result_Id: "a",
              sitename: a,
              mcselected: b,
              note: "",
              resultdate: e.toString(),
              crosssite: c,
              status: "Request",
              astatus: "Active"
            };
            
    // validations againts site url and measurement criteria       
    if(a != '' && b != ''){      
    
    $.ajax({
          type: "POST",
          url: $g +"/admin/admin-ajax.php",
          data: h,
          success: function( msg ) {             
            location.reload();
          }
      });  
    
    }
    
  });
  
  // Code to delete site request (Role: USER)
  $('.delete').click(function(){
   
     if($user == 'User'){

       // Setting ajax data
       var p = {
           pur: 'deleterequest',
           table: 'sitelog',
           column: 'status',
           value: 'Deactive',
           where: $(this).parent().attr('id')
      }; 
     
     $.ajax({
          type: "POST",
          url: $g +"/admin/admin-ajax.php",
          data: p,
          success: function(a) { 
            location.reload();
          }
       }); 
     }
     
  });
    
  /*----------------ADMIN-------------------*/
  
  // Set up site status [step] on page load (Role: ADMIN)
  if($user == 'Admin') {
    
    $('.results').each(function() { 
      
      var aa = $(this),
      
      // Setting admin data.
          q = {
                pur: 'chkadminstatus',
                table: 'sitelog',
                colomn: 'result_Id',
                where: $(this).attr('id')
              };
      
      $.ajax({
              type: "POST",
              url: $g +"/admin/admin-ajax.php",
              data: q,
              success: function(a) { 
                
              aa.addClass(a);
              if(aa.hasClass('a') == true){
                
                
                aa.children('ul').children('li').hide();
                aa.children('ul').children('.step1').show();
                
              } else
              if(aa.hasClass('b') == true) { 
                
                aa.children('ul').children('li').hide();
                aa.children('ul').children('.step2').show();    
                
              } else
              if(aa.hasClass('c') == true) {         
               
                aa.children('ul').children('li').hide();
                aa.children('ul').children('.step3').show();
                
              } else
              if(aa.hasClass('d') == true) {        
               
                aa.children('ul').children('li').hide();
                aa.children('ul').children('.step4').show();
                aa.children('.next-step').hide();
                
             }            
          }
      }); // End of AJAX
      
    });
  }
  
  // Setting and getting Site status [Steps] on click on Next button (Role: ADMIN).
  $('.next-step').on('click', function() {
    
    var d = 'a',        // Variable to send with AJAX request.
        i = $(this),
        p = i.parent();
   
    if(p.hasClass('a') == true){ 
      
      d = 'b';
      p.removeClass('a');      
      p.children('ul').children('li').hide();
      p.children('ul').children('.step2').show();  


      p.addClass('b');
      
    } else
    if(p.hasClass('b') == true) { 
      
      d = 'c';
      p.removeClass('b');
      p.children('ul').children('li').hide();
      p.children('ul').children('.step3').show();
      p.addClass('c'); 
      
    } else
    if(p.hasClass('c') == true) { 
      
      d = 'd';       
      p.removeClass('c');  
      p.children('ul').children('li').hide();
      p.children('ul').children('.step4').show();
      p.addClass('d');
      i.hide();
            
    }
  
      // Setting admin data.
      var q = {
            pur: 'updatestep',
            table: 'sitelog',
            table2: 'resultlog',
            column: 'result_Id',
            value: d,
            where: p.attr('id'),
            analysts: p.children('ul').children('li').children('.analyststat').val(),
            mcs: p.children('ul').children('li').children('.mcs').text(),
            deadline: p.children('ul').children('.step3').children('input').val(),
            sitename: p.children('.sitename').text(),
            indexl: p.children('.indexl').val()           
      }; 
      
     $.ajax({
          type: "POST",
          url: $g +'/admin/admin-ajax.php',
          data: q,
          success: function(a) {
            if(a != ' '){                 
                p.append('<input type="hidden" class="indexl" value="' + a + '">');
              }
         }
     }); 
    
  }); // End of Next button click function (Role: ADMIN).
  
  /*----------------ANALYST-------------------*/
  
  
  if($user == 'Analyst') {
    
    // Set up site status [step] on page load (Role: ANALYST).
    $('.results').each(function(e){
      
    var $pthis = $(this),
        statid = $pthis.children('.site-id').val();
        
     $pthis.children('ul').children('li').each(function(b) { 
      
      $(this).css('height',0);
      $(this).css('overflow','hidden');      
            
    });
    $pthis.children('ul').children('.an-step-'+statid).css('height','auto');
    if(statid == '-1')
      $pthis.children('.nextbtn').hide();
    
    });
    
    // Next button functionality (Role: ANALYST).
    $('.nextbtn').click(function() {
     
      var $this = $(this),
      hiddenpoints = $this.parent().children('.log').val(),
      hiddenrelid = $this.parent().children('.rel-Id').val(),
      hiddenstatus = parseInt($this.parent().children('.site-id').val()), 
      recomentation = $this.parent().children('ul').children('.an-step-0').children('textarea').val(),
      mccount = 0;
      alert(recomentation);
      $this.parent().children('ul').children('li').each(function(e){
        mccount = e+1;
      });
      
      // Enables recomentation textarea.
      if( (mccount-2) == hiddenstatus ) {
       
        hiddenstatus = -1;
       
      }
      
     // Completed whole scoring journey.
     if(hiddenstatus == 0) {
       
        hiddenstatus = -2;
       
      }
      
      var q = {
            pur: 'updateanstep',
            table: 'resultlog',
            column: 'points',
            column2: 'recomentations',
            value: hiddenpoints,
            stat: hiddenstatus,
            where: hiddenrelid,
            recom: recomentation
      }; 
      
     $.ajax({
          type: "POST",
          url: $g +'/admin/admin-ajax.php',
          data: q,
          success: function(a) {
            location.reload();
            //alert(a);
         }
     }); 
          
      
    });
  
  }
}); // End of Document ready.