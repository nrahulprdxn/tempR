(function($){
  var methods = {
    init: function() {},
    
    setPopUpInitials: function() {
      var doc_width = $(document).width(), doc_height = $(document).height();  
      $('#info-block-container').width(doc_width).height(doc_height);
      $('#glossary-block-container').width(doc_width).height(doc_height);
      var i = 0;
      $(".galaxy-content-block ul li").each(function() {
        $(this).attr('data-content', i++);
      });
    }    
  };
  
  $.fn.setInitials = function( method ) {
    if(methods[method]) {
      return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
    } else if(typeof method === 'object' || !method) {
      return methods.init.apply(this, arguments);
    } else {
      alert('Method '+ method +' does not exist in setInitials.');
    }
  }
})(jQuery);