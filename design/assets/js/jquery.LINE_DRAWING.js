(function($) {
  var left_top = [],
      right_top = [],
      relational_array = [],
      width_left = [247, 391, 364, 421, 331, 167, 302, 263, 281, 401, 184, 301, 238, 413, 174], 
      width_right = [237, 395, 356, 257, 294, 420, 491, 237, 474, 356, 411, 327, 327, 327, 484, 377, 327, 294, 327, 327, 267, 327, 267, 245, 245, 420, 327, 327, 327, 356, 327, 357, 411, 237],
      right_click = false, current_right_pointer = 50,
      $line_section = $('#lines-secton'),
      $disease_lists = $('.disease-content-block ul li'),
      $galaxy_lists = $('.galaxy-content-block ul li'),
      $right_horizontal = $('.right-horzintal'),
      methods = {
    init: function() {
      var offset_diseas_values = [],
          offset_galaxies_values = [], 
          respective_diseas_height = [],
          respective_galaxies_height = [],
          relation_array = [], 
          reducable_offset = $line_section.offset().top,
          left_lines_top_positions = [],
          right_lines_top_positions = [],
          mapping_data_left = [],
          mapping_data_right = [],
          counter_left = 0,
          counter_right = 0;
      $line_section.height($('#galaxy-container').height()+'px');
      $disease_lists.each(function() {
        var $this = $(this);
        offset_diseas_values.push($this.offset().top - reducable_offset);
        respective_diseas_height.push($this.height());
        mapping_data_left.push($this.attr('data-for'));
        counter_left++;
      });
      $galaxy_lists.each(function() {
        var $this = $(this);
        offset_galaxies_values.push($this.offset().top - reducable_offset);
        respective_galaxies_height.push($this.height());
        mapping_data_right.push($this.attr('data-topic'));
        $(this).addClass($this.attr('data-topic'));
        counter_right++;
      });
      for(var i = 0; i < counter_left; i++ ) {
        var calc_val_lft = offset_diseas_values[i] + (respective_diseas_height[i] / 2) - 3 + 2;
        left_lines_top_positions.push(calc_val_lft);
      }
      for(var j = 0; j < counter_right; j++) {
        var calc_val_right = offset_galaxies_values[j] + (respective_galaxies_height[j] / 2) - 3 + 7;
        right_lines_top_positions.push(calc_val_right);
      }
      for(var l = 0; l<counter_left; l++) {
        var map_left = mapping_data_left[l];
          var relate_str = '';
          for(var m = 0; m<counter_right;m++) {
            if(map_left === mapping_data_right[m]) {
              relate_str = relate_str + m+' ';                
            } 
          }
          relation_array.push(relate_str);
      }
      methods.setRelationslLines(left_lines_top_positions, right_lines_top_positions, relation_array);
    },
    setRightClickValue: function( $current_element, data ) {
      right_click = data;
      if(data) {
        current_right_pointer = Number($current_element.attr('data-content'));
      } else {
        current_right_pointer = 50;
      }
    },
    getRelationalArray: function() {
      return relational_array;
    },
    
    setRelationslLines: function(lft_arr, rght_arr, relation_array) {
      var i = 0, j = 0; 
      $('.left-horizontal').each(function() {
        var $this = $(this);
        $this.animate({left: '0', top: lft_arr[i]+'px' }).css({'width': width_left[i]+'px'});
        i++;
      });
      $right_horizontal.each(function() {
        var $this = $(this);
        $this.animate({right: 0, top: rght_arr[j]+'px' }).css({'width': width_right[j]+31+'px'});
        j++;
      });
      left_top = Array.prototype.slice.call(lft_arr);
      right_top = Array.prototype.slice.call(rght_arr);
      relational_array = Array.prototype.slice.call(relation_array);
    },
    getLeftAndRightTopPositions: function() {
      return {
        'left_top': left_top,
        'right_top': right_top
    };
    },
    setMixedLinesForAllCatagories: function() {},
    
    setHorizontalLines: function( currentElement ) {
      $('.active-lines').fadeOut('fast');
      $galaxy_lists.removeClass('select-galaxy');
      $disease_lists.removeClass('select-galaxy');
      $galaxy_lists.removeClass('select-galaxy-darker');
      $('.right-horzintal , .left-horizontal , #vertical-line').removeClass('active-lines');
      $right_horizontal.removeClass('active-heighlighted');
      var currentSelected = currentElement.attr('data-mapping'),
          currId = 'left-'+currentSelected,
          curr_rel_array = [],
          rght_rel_id = [],
          rel_length;
      $('#'+currId).addClass('active-lines');
      curr_rel_array = (relational_array[currentSelected]).split(' ');
      rel_length = curr_rel_array.length - 1;
      if(right_click){
        for(var i = 0; i< rel_length; i++) {
        var curr_rght = 'right-'+curr_rel_array[i];
        rght_rel_id.push(curr_rght);
        if(curr_rel_array[i] == current_right_pointer) {
          $('#'+curr_rght).addClass('active-heighlighted');
        }
        else{
          $('#'+curr_rght).addClass('active-lines');
        }
      }
      } else {
        for(var i = 0; i< rel_length; i++) {
        var curr_rght = 'right-'+curr_rel_array[i];
        rght_rel_id.push(curr_rght);
          $('#'+curr_rght).addClass('active-heighlighted');
        }
      }
      return methods.setVerticalLines(curr_rel_array, currentSelected, currentElement);
    },
    
    setVerticalLines: function(arr, pos, $currentElement) {
      var last_index = arr.length - 1,
          left_upper = left_top[pos],
          right_upper =  right_top[arr[0]],
          right_bottom = right_top[arr[last_index - 1]],
          max_val = 0,
          resulted_left = width_left[pos],
          curr_data_attr = $currentElement.attr('data-for'),
          resulted_height,
          resulted_top;
      if(left_upper < right_upper) {
        resulted_top = left_upper;
      } else {
        resulted_top = right_upper;
      }
      if(right_bottom > left_upper) {
        max_val = right_bottom; 
      } else {
        max_val = left_upper;
      }
      resulted_height = max_val - resulted_top;
      if(right_click) {
        var max_selected, min_selected, selected_height;
        var selected_left_top  = left_top[pos] ,selected_right_top = right_top[current_right_pointer], $heighlighted_one = $galaxy_lists.eq(current_right_pointer);
        
        if(selected_left_top > selected_right_top) {
          max_selected = selected_left_top;
          min_selected = selected_right_top;
        } else {
          max_selected = selected_right_top; 
          min_selected = selected_left_top;
        }
        selected_height = (max_selected - min_selected) + 6;
        $('#adjustable-line').addClass('active-lines').css({'left':resulted_left+'px', 'top': min_selected+'px', 'height': selected_height+'px'});
      } else {
        $('#adjustable-line').addClass('active-lines').css({'left': resulted_left+'px','top' :(resulted_top)+'px','height': (resulted_height+6)+'px'});
      }
      
      return $('#vertical-line').addClass('active-lines').animate({left: resulted_left+'px',top :(resulted_top)+'px',height: (resulted_height+6)+'px'},
      function() {
        if( right_click ) {
          $('.galaxy-content-block ul li.'+curr_data_attr).not($heighlighted_one).addClass('select-galaxy');
          $heighlighted_one.addClass('select-galaxy-darker');
          
        } else {
          $('.galaxy-content-block ul li.'+curr_data_attr).addClass('select-galaxy-darker');
        }
        $('.active-lines, .active-heighlighted').fadeIn('fast');
        
        $currentElement.addClass('select-galaxy');
        return true;
      });
    },
    
    popUpFunctional: function( $current_elememt ) {
      var data_topic = $current_elememt.attr('data-topic'),      
          $curr_item;
      $disease_lists.each(function() {
        if($(this).attr('data-for') === data_topic) {
          $curr_item = $(this);
          return false;
        }
      });
      methods.setHorizontalLines($curr_item);
      $('#info-block-container').show('clip','vertical',200, function() {
        $('#info-block').show();
        $(this).clickHandeling('openPopUp', $current_elememt, data_topic);
        $('#glossary').css('background', 'url(assets/images/glossary-open.pop.up.jpg)');
      });
    }
  };
	
  $.fn.setRelationship = function( method ) {
    if(methods[method]) {
      return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
    } else if(typeof method === 'object' || ! method) {
      return methods.init.apply(this, arguments);
    } else {
      alert('Method '+ method +' is not valid method for setRelationship');
    }
  };
})(jQuery);
