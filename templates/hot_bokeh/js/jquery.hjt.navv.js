/*------------------------------------------------------------------------
# "Sparky Framework" - Joomla Template Framework
# Copyright (C) 2013 HotThemes. All Rights Reserved.
# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
# Author: HotThemes
# Website: http://www.hotjoomlatemplates.com
-------------------------------------------------------------------------*/

(function(jQuery){  
 jQuery.fn.dropDownMenu = function(options) {  
  
  var defaults = {  
   speed: 300,  
   effect: 'fadeToggle'
  };  
  var options = jQuery.extend(defaults, options);  
      
  return this.each(function() { 

    jQuery('.navv ul').hide();
    jQuery('.navv li ul li').filter(':last-child').css('border-bottom', 'none');
    jQuery('.navv li').hover(function(){
      jQuery(this).find('ul:first:not(:visible)').stop(true,true)[options.effect](options.speed);
    },function(){
      jQuery(this).css('position', 'relative')
                  .find('ul:first:visible').stop(true,true)[options.effect](options.speed);
    });

  });  
 };  
})(jQuery);  