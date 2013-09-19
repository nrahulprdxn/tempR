$(document).ready(function() {

// Global variable val for storing values of score given by analysts (ROLE:ANALYST)
var $val = '',
    $original = '';
  
  // Default score in hidden field (ROLE:ANALYST)
  $('.results').each(function(i){
  var $this = $(this),
      $child = $(this).children('ul').children('li'),
      $val = '',
      $vals = '';
      
      
      $child.each(function(){
        
      if($(this).children().hasClass('score')){
      
        $vals = $(this).children('.score').val();      
        $val += $vals + ',';
      }  
      }); 
      $this.children('.log').val($val);
    });
  
  $('.score').click(function(){
    var $this = $(this);
    $original = $this.val();
    $this.val('');
  });
  
  // Stores new score on blur of input box (ROLE:ANALYST)      
  $('.score').blur(function(){
    var $this = $(this),
      $parent = $this.parent().parent().parent(),
      $valus,
      $valu = '';
      
      if($this.val() == '')
        $this.val($original);
      
      $parent.children('ul').children('li').children('.score').each(function(){
        
        $valus = $(this).val();
        $valu += $valus + ',';
        
      });
      
    $parent.children('.log').val($valu);
    
  });
  
 
});
 