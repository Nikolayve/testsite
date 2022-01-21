﻿/*------------------------------------------------------------------------
# "Sparky Framework" - Joomla Template Framework
# Copyright (C) 2013 HotThemes. All Rights Reserved.
# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
# Author: HotThemes
# Website: http://www.hotjoomlatemplates.com
-------------------------------------------------------------------------*/

(function(jQuery, undefined) {
    jQuery.widget("hjt.accmenu", {
        options: {
         	collapsible: true,
			equalheight: false,
			event: 'click',//click|mouseover
			animation:'slide', //bounceslide|slide
			subpanelslide:'right',// right|down
			subpanelspeed:450
        },
		
        _create: function() {
            var self = this,
                options = self.options;
            var el = jQuery(this.element);
			
			el.accordion({
				autoHeight: options.equalheight,
				collapsible: options.collapsible,
				event: options.event,
				animated: options.animation,
				navigation:true
		    });
			
			el.find('> li > a').click(function(){
			  if(!jQuery(this).parent().find('UL, LI')[0]){
			    var link = jQuery(this).attr('href');
				if(link == "#" || link == "javascript:;" || link == "javascript:void(0);") return;
				window.location = link;
			  }
			}); 
			
			el.find('> li > ul > li  ul').css({
		 	 display:'none',
			 position:'absolute'
			});
			
			el.find('> li > ul > li, > li > ul > li ul li ').each(function(ind){
			 if(jQuery(this).find('> ul')[0]){
			   jQuery(this).find('> ul').insertBefore(jQuery(this).find('> a'));
			   
			   
			   
			   var parMargin = 0;
				var par = jQuery(this).parent();
				
				while(!par.parent().parent().hasClass('acc')){
				  if(par.is('UL')){
				    parMargin += parseInt(par.css('marginLeft') );
				  }
				  par = par.parent();
				}
			 
               if(el.position().left < (jQuery(window).width() - el.innerWidth()) / 2){
			    jQuery(this).find('> ul').find('> li').innerWidth(el.innerWidth() - 10);
			    jQuery(this).find('> ul').css('marginLeft',String( parMargin + jQuery(this).parent().innerWidth() - parseInt(jQuery(this).css('paddingLeft'))  - parseInt(jQuery(this).css('marginLeft')) ) + 'px');
				
			   }else{
			    jQuery(this).find('> ul').find('> li').innerWidth(el.innerWidth() - 10); 
			    jQuery(this).find('> ul').css('marginLeft',"-" + String(  (-parMargin) + jQuery(this).parent().innerWidth()) + 'px');
			   } 
			 }
			});
			
			el.find('> li > ul > li, > li > ul > li ul li ').mouseenter(function(){
			 if(jQuery(this).find('> ul')[0]){
				jQuery(this).find('> ul').css('zIndex',parseInt(jQuery(this).find('> ul').css('zIndex')) + 1);
			    if(options.subpanelslide == 'right'){
				    	jQuery(this).find('> ul:::not(visible)').animate({width:'toggle'},options.subpanelspeed);
				}else{
				  jQuery(this).find('> ul:::not(visible)').slideDown(options.subpanelspeed);
				}
			 } 
			});
			
			el.find('> li > ul > li, > li > ul > li ul li ').mouseleave(function(){
			 if(jQuery(this).find('> ul')[0]){
			    if(options.subpanelslide == 'right'){
				   	jQuery(this).find('> ul:visible').animate({width:'toggle'},options.subpanelspeed/3);
				}else{
				  jQuery(this).find('> ul:visible').slideUp(0);
				}
			 }
			});
	    },

        _setOption: function(key, value) {
            this.options[key] = value;
        },

        destroy: function() {
            jQuery(this.element).html(this._baseHTML);
            jQuery.Widget.prototype.destroy.call(this);
        }
    }); // widget
})(jQuery);
