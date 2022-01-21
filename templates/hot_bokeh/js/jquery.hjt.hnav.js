/*------------------------------------------------------------------------
# "Sparky Framework" - Joomla Template Framework
# Copyright (C) 2013 HotThemes. All Rights Reserved.
# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
# Author: HotThemes
# Website: http://www.hotjoomlatemplates.com
-------------------------------------------------------------------------*/

jQuery(document).ready(function(){

  jQuery('UL.navh').each(function(ind){
     var navh  = jQuery(this);
	 var navhs = jQuery('<div class="navh_submenu"></div><div class="clr></div>');
     navhs.insertAfter(navh);
	 
	 navh.find('> li').each(function(ind){
	    jQuery(this).attr('iindex',ind);
		if(jQuery(this).find("> UL")[0]){
			jQuery(this).find("> UL").attr('iindex',ind);
		}
	 });
	 
     navh.find('> li > UL').appendTo(navhs);
	 
     navhs.find('> UL').css('zIndex',100);
     navh.find('> li.active').addClass('active_tab');
	 navhs.find('> UL[iindex="' + navh.find('> li.active').attr('iindex') + '"]').css('zIndex',80).addClass('current_sub active_sub');
	 
	 navhs.find('> UL LI.parent').hover(
		 function(){
			jQuery(this).children('ul').stop().slideToggle();
		 },
		 function(){
			jQuery(this).children('ul').stop().slideToggle();
		 }
	 );
	 
	 navhs.find('> UL UL').stop().slideToggle();
	  
	 navh.find('> li:not(.current)').hover(
	 function(){
		
	    navh.find('.in_hover').removeClass('in_hover');
		navhs.find('.in_hover').removeClass('in_hover');
		
		navh.find('.active_tab').removeClass('active_tab');
		navhs.find('.active_sub').removeClass('active_sub');
	    
		jQuery(this).addClass('active_tab in_hover');
		navhs.find('> UL[iindex="' + jQuery(this).attr('iindex') + '"]').addClass('active_sub');
		
	 },
	 function(){
		jQuery(this).removeClass('in_hover');
		var mitem = jQuery(this);
		var stab  = navhs.find('> UL[iindex="' + mitem.attr('iindex') + '"]');
		
		setTimeout(function(){
			if(!(stab.is('.in_hover') || mitem.is('.in_hover'))){
			    if(!(navh.find('.in_hover')[0] || navhs.find('.in_hover')[0])){
					mitem.removeClass('active_tab');
					stab.removeClass('active_sub');
					navh.find('> li.active').addClass('active_tab');
					navhs.find('> UL[iindex="' + navh.find('> li.active').attr('iindex') + '"]').addClass('active_sub');
				}
			}
		},50);
	 });
	 
	 navhs.find('> UL:not(.current_sub)').hover(
	 function(){
	    navh.find('.in_hover').removeClass('in_hover');
		navhs.find('.in_hover').removeClass('in_hover');
	    jQuery(this).addClass('in_hover');
	 },
	 function(){
	    jQuery(this).removeClass('in_hover');
		
		var stab  = jQuery(this);
		var mitem = navh.find('> LI[iindex="' + stab.attr('iindex') + '"]');
		
		setTimeout(function(){
			if(!(stab.is('.in_hover') || mitem.is('.in_hover'))){
				if(!(navh.find('.in_hover')[0] || navhs.find('.in_hover')[0])){
					mitem.removeClass('active_tab');
					stab.removeClass('active_sub');
					
					navh.find('> li.active').addClass('active_tab');
					navhs.find('> UL[iindex="' + navh.find('> li.active').attr('iindex') + '"]').addClass('active_sub');
				}
			}
		},50);
	 }
	 );
  });

});
