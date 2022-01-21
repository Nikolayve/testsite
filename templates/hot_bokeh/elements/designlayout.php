<?php
/*------------------------------------------------------------------------
# "Sparky Framework" - Joomla Template Framework
# Copyright (C) 2013 HotThemes. All Rights Reserved.
# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
# Author: HotThemes
# Website: http://www.hotjoomlatemplates.com
-------------------------------------------------------------------------*/

defined('JPATH_BASE') or die;

jimport('joomla.form.formfield');

/**
 * Form Field class for the Joomla Framework.
 *
 * @package		Joomla.Framework
 * @subpackage	Form
 * @since		1.6
 */
class JFormFieldDesignLayout extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'designlayout';

	/**
	 * Method to get the field input markup.
	 *
	 * @return	string	The field input markup.
	 * @since	1.6
	 */
	protected function getInput()
	{
        $OUT= '';
	    ob_start();
		?>
		<div id="layoutdesigner<?php echo $this->id; ?>">
		 <input type="hidden" name="<?php echo $this->name; ?>" id="<?php echo $this->id; ?>" value="<?php echo $this->value; ?>" />
		 <table class="layoutDesigner">
		  <tr>
		   <td class="ui-state-default" style="background-position: 50% 0;">
		     <ul class="toolBox ">
	          <li class="edit_row" id="layout_addRow" style="background-position: 50% 0;">
			    <span class="caption" ><?php echo jText::sprintf('TPL_HOT_BOKEH_ADD_ROW') ;?></span>
 			    <table cellpadding="0" cellspacing="0">
				 <tr>
                 <td>	
				    <table cellpadding="0" cellspacing="0">
				     <tr><td><a href="javascript:void(0);" class="deleteRow"></a></td><td><span><?php echo jText::sprintf('TPL_HOT_BOKEH_NAME') ;?></span></td><td> <input style="width:65px;" type="text" class="layoutrow_name" value="" /> </td></tr>
                     <tr><td></td><td><span><?php echo jText::sprintf('TPL_HOT_BOKEH_CLASS') ;?></span></td><td> <input style="width:65px;" type="text" class="layoutrow_class" value="" /> </td></tr>					 
					</table>
				 </td>
				 <td>
				   <div class="layout_row_container">
                    <ul class="layout_row">
					
                    </ul>
                   </div>					
				 </td>
				 </tr>
				</table>
			  </li>
			  <li class="ui-state-default" style="background-position: 50% 0;">
			     <span class="caption" ><?php echo jText::sprintf('TPL_HOT_BOKEH_UNASSIGNED_MODULE_POSTIONS'); ?></span>
			     <ul class="unassignedPositions drag_module_postions" >
				 <?php
					global $tadmin_mpos; 
					echo '<li wX="1" off="0" mp="joom_content" class="mpos_draggable cpos" ><span>['.jText::sprintf('TPL_HOT_BOKEH_CONTENT_BOX').']</span><div class="clr" ></div><a title="Move left" href="javascript:void(0);" class="off_left"  >.</a><a  title="Move right" href="javascript:void(0);" class="off_right" >.</a></li>';
					foreach($tadmin_mpos as $mpos){
						if($mpos!="abovecontent" && $mpos!="belowcontent") {
					  		echo '<li wX="1"  off="0" mp="'.$mpos.'" class="mpos_draggable '.$mpos.'" ><span>'.$mpos.'</span><div class="clr" ></div><a  title="Move left" href="javascript:void(0);" class="off_left"  >.</a><a   title="Move right" href="javascript:void(0);" class="off_right"  >.</a></li>';
						}
					}
                    //echo '<li wX="1" mp="joom_empty" class="mpos_draggable emptycell" >['.jText::sprintf('TPL_HOT_BOKEH_EMPTY').']</li>';					
			      ?>
				 </ul>
			  </li>
             </ul>
			 </td>
		   </tr>
		   <tr>
		   <td>
		   <div class="LayoutModel">
		     <ul id="sortable">
			   
			 </ul>    
		   </div>
		   </td>
		   </tr>
		 </table>
		 <script type="text/javascript">
		   
		   
		 
		   window.setTimeout(function(){
		   
		        if(window.layoutEditorLoaded<?php echo $this->id; ?>){ 
				return;
				}
				window.layoutEditorLoaded<?php echo $this->id; ?> = true;
				
				
				
				jQuery( "#layoutdesigner<?php echo $this->id; ?> #sortable" ).sortable({
					revert: true,
					receive: function(event, ui) { 
				     window.hookRowEvents<?php echo $this->id; ?>(); 
					}
				});
				
				jQuery( "#layoutdesigner<?php echo $this->id; ?> #layout_addRow" ).click(function(){
				     var row = jQuery('#layoutdesigner<?php echo $this->id; ?> #layout_addRow').clone(false).first();
					 row.removeAttr('id');
					 row.removeClass('ui-state-hover');
					 jQuery('#layoutdesigner<?php echo $this->id; ?> #sortable').append(row);
					 window.hookRowEvents<?php echo $this->id; ?>();
				});
				
				jQuery( "#layoutdesigner<?php echo $this->id; ?> ul, #layoutdesigner<?php echo $this->id; ?> li" ).disableSelection();
				
				jQuery('#layoutdesigner<?php echo $this->id; ?> #layout_addRow').button({ text: true, icons: { primary: 'ui-icon-plusthick'} });
				
			    jQuery('#layoutdesigner<?php echo $this->id; ?> .off_left').addClass('ui-widget-content ui-icon ui-icon-triangle-1-w');
				jQuery('#layoutdesigner<?php echo $this->id; ?> .off_right').addClass('ui-widget-content ui-icon ui-icon-triangle-1-e');
				
				
				jQuery('#layoutdesigner<?php echo $this->id; ?> .off_left').click(function(){
				  if(jQuery(this).parent().parent().hasClass('layout_row')){
				     if(parseInt(jQuery(this).parent().css('marginLeft')) > 10){
						 var off = parseInt(jQuery(this).parent().attr('off'));
						 jQuery(this).parent().attr('off',off - 1);
						 jQuery(this).parent().css('marginLeft', String((off - 1) * 52) + 'px' );
					 }
				  }
				});
				
				jQuery('#layoutdesigner<?php echo $this->id; ?> .off_right').click(function(){
				  if(jQuery(this).parent().parent().hasClass('layout_row')){
				     var totalRowW = 0;
					 jQuery(this).parent().parent().find('.mpos_draggable').each(function(ind){
					    totalRowW += (jQuery(this).innerWidth() + parseInt(jQuery(this).css('marginLeft')));
					 });
					 
					 if(totalRowW < 615){
						 var off = parseInt(jQuery(this).parent().attr('off'));
						 jQuery(this).parent().attr('off',off + 1);
						 jQuery(this).parent().css('marginLeft', String((off + 1) * 52) + 'px' );
					 }
				  }
				});
			    

 			    jQuery('#layoutdesigner<?php echo $this->id; ?> .unassignedPositions').sortable({
				  connectWith: "#layoutdesigner<?php echo $this->id; ?> .drag_module_postions",
				  revert: true
			    }).disableSelection();
			   
			    //jQuery('#layoutdesigner<?php echo $this->id; ?> .layoutDesigner').parent().parent().parent().find('LI').first().hide();
			    //jQuery('#layoutdesigner<?php echo $this->id; ?> .layoutDesigner').parent().parent().find('LABEL').hide();
				
				
				
			
		 
           window.hookRowEvents<?php echo $this->id; ?> = function(){
		     jQuery('#layoutdesigner<?php echo $this->id; ?> .LayoutModel .edit_row:not([hooked])').each(function(ind){
			     jQuery(this).attr('hooked',true);
				 
				 jQuery(this).find('.deleteRow')
				 .button({ text: true, icons: { primary: 'ui-icon-closethick'} })
				 .click(function(){
					 if(confirm("Delete layout row?")){
					   var r_el = jQuery(this).closest('.edit_row');
					   r_el.find('.mpos_draggable').appendTo(jQuery('#layoutdesigner<?php echo $this->id; ?> .unassignedPositions'));
					   r_el.remove();
					 }
				 });
				 
				 jQuery(this).find('.layout_row').attr('id','ID_' + String(Math.floor(Math.random()*1000000)));
                 jQuery(this).find('.layout_row').addClass('drag_module_postions');
				 jQuery(this).find('.layout_row').sortable({
					connectWith: "#layoutdesigner<?php echo $this->id; ?> .drag_module_postions",
					revert: true,
					receive: function(event, ui) { 
					
  				     ui.item.css('marginLeft',0);
					 ui.item.attr('off',0);
					 var totalRowW = 0;
					 ui.item.parent().find('.mpos_draggable').each(function(ind){
					    totalRowW += (jQuery(this).innerWidth() + parseInt(jQuery(this).css('marginLeft')));
					 });
					 
					 if(totalRowW > 630){
					   var avail = (626 - (totalRowW - ui.item.innerWidth()));
					   var diff  = ui.item.innerWidth() - avail; 
					   if( avail > 10){
					      var avail_pos = Math.round(avail / 52);
						  ui.item.innerWidth( avail_pos * 52 - 2 );		
                          ui.item.attr('wX', avail_pos);
					   }else{
					      ui.item.appendTo(ui.sender);
					   }
					 }
					}
				 }).disableSelection();
			 });
		   }
		   
		   window.save_layout<?php echo $this->id; ?> = function (){
		      var serialised = '';
		      jQuery('#layoutdesigner<?php echo $this->id; ?> .LayoutModel .edit_row').each(function(ind){
			     var entry = jQuery(this).find('.layoutrow_name').first().val() + '+' +
				             jQuery(this).find('.layoutrow_class').first().val() + '+';
				 var mposs = '';
				 jQuery(this).find('.mpos_draggable').each(function(index){
				     if(mposs != ''){
					   mposs = mposs + ',';
					 }
					 mposs = mposs + jQuery(this).attr('mp') + '=' + jQuery(this).attr('wX') + '=' + jQuery(this).attr('off');
				 });			 
				 entry += mposs;
				 if(serialised != ''){
				   serialised = serialised + '&';
				 }
				 serialised = serialised + entry;
			  });
              jQuery('#<?php echo $this->id; ?>').val(serialised);
		   }
		   
		   window.load_layout<?php echo $this->id; ?> = function(){
		       try{
				   var value = jQuery('#<?php echo $this->id; ?>').val().split('&');
				   for(var i = 0; i < value.length;i++){
					 value[i] = value[i].split('+');
					 value[i][2] = value[i][2].split(',');
					 var row = jQuery('#layoutdesigner<?php echo $this->id; ?> #layout_addRow').clone(false).first();
					 row.removeAttr('id');
					 jQuery('#layoutdesigner<?php echo $this->id; ?> #sortable').append(row);
					 row.find('.layoutrow_name').first().val(value[i][0]);
					 row.find('.layoutrow_class').first().val(value[i][1]);					 
					 for(var j = 0; j < value[i][2].length;j++){
					    var pName  = value[i][2][j].split('=')[0];
						var pWidth = parseInt(value[i][2][j].split('=')[1]);
						var pOff   = parseInt(value[i][2][j].split('=')[2]);
						
						if(String(pWidth) == 'NaN')pWidth = 50;
						if(String(pOff) == 'NaN')pOff = 0;
						
						var box = null;
						box = jQuery('#layoutdesigner<?php echo $this->id; ?> .unassignedPositions .mpos_draggable[mp="' + pName + '"]');
					    box.appendTo(row.find('.layout_row').first());
						box.attr('wX',pWidth);
						box.attr('off',pOff);
						
						box.innerWidth(pWidth * 52 - 2);
						box.css('marginLeft',String(pOff * 52) + 'px');
					 }
				   }
				   window.hookRowEvents<?php echo $this->id; ?>();
               }catch(ex){
			   }
			   
			   window.setInterval( function(){
			     jQuery('#layoutdesigner<?php echo $this->id; ?> .unassignedPositions .mpos_draggable').resizable( "disable" );
				 jQuery('#layoutdesigner<?php echo $this->id; ?> .unassignedPositions .mpos_draggable').css({'width':'70px'});
				 jQuery('#layoutdesigner<?php echo $this->id; ?> .unassignedPositions .mpos_draggable').css({'width':'auto'});
				 jQuery('#layoutdesigner<?php echo $this->id; ?> .LayoutModel .mpos_draggable').resizable( "enable" );
				
			     if( jQuery('#layoutdesigner<?php echo $this->id; ?> #sortable .edit_row').length == 0){
					 if( jQuery('#layoutdesigner<?php echo $this->id; ?> #sortable .initialRow').length == 0){
					   jQuery('#layoutdesigner<?php echo $this->id; ?> #sortable').append(jQuery('<li class="initialRow"><?php echo jText::sprintf('TPL_HOT_BOKEH_ADD_DRAG'); ?></li>')); 
					 }
				 }else{
				     if( jQuery('#layoutdesigner<?php echo $this->id; ?> #sortable .initialRow').length > 0){
					   jQuery('#layoutdesigner<?php echo $this->id; ?> #sortable .initialRow').remove();
					 }
				 }
			     window.save_layout<?php echo $this->id; ?>();
			   },350);
		   }
		   
		   window.load_layout<?php echo $this->id; ?>();
		   
		    jQuery('#layoutdesigner<?php echo $this->id; ?> .mpos_draggable').resizable({
					maxHeight: 48,
					maxWidth: 660,
					minHeight: 48,
					minWidth: 50,
					grid:52,
					handles: 'e',
					stop: function(event, ui) { 
					  var cells =Math.round(jQuery(this).innerWidth() / 52);
					  jQuery(this).attr('wX', cells);
					  
					  if(jQuery(this).parent().hasClass('layout_row')){
					    var RowTotalW = 0;
						jQuery(this).parent().find('.mpos_draggable').each(function(ind){
						   RowTotalW += (jQuery(this).innerWidth() + parseInt(jQuery(this).css('marginLeft'))) ;
						});
						
						if(RowTotalW > 626){
						  var diff =  Math.round(( RowTotalW - 626) / 52);
                          jQuery(this).innerWidth( (cells - diff) * 52 - 2 );		
                          jQuery(this).attr('wX', (cells - diff));						  
						}
					  }
					}
			});
		   
		   
		  },700);
		   
		   
		 </script>
		 
		</div> 
		 
		<?php
		$OUT = ob_get_contents();
        ob_end_clean();		
        return $OUT;
	}
}
