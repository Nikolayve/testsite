<?php
/*------------------------------------------------------------------------
# "Sparky Framework" - Joomla Template Framework
# Copyright (C) 2013 HotThemes. All Rights Reserved.
# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
# Author: HotThemes
# Website: http://www.hotjoomlatemplates.com
-------------------------------------------------------------------------*/
if($LoadMENU_Acc){ ?>
<link rel="stylesheet" href="<?php echo $template_path ?>/css/menu_accordion.css" type="text/css" />
<script type="text/javascript" src="<?php echo $template_path ?>/js/jquery.hjt.accmenu.js"></script>
<script type="text/javascript">
<?php
foreach($mnucfg as $menu_name => $menu){
  if($menu['type'] == "acc"){ ?>
     jQuery(document).ready(function(){
	  jQuery('.mnu_<?php echo $menu_name;?>').accmenu({
				collapsible: <?php echo $menu['collapsible'] == "1"? "true" : "false"; ?>,
				equalheight: <?php echo $menu['equalheight'] == "1"? "true" : "false"; ?>,
				event:'<?php echo $menu['trigger']; ?>',
				animation:'<?php echo $menu['animation']; ?>',
				subpanelslide:'<?php echo $menu['subpanelslide']; ?>',
				subpanelspeed: <?php echo $menu['animation_speed']; ?>
	  });
	 });
  <?php
  }
}
?>
</script>
<?php
}

if($LoadMENU_Navh){?>
<script type="text/javascript" src="<?php echo $template_path ?>/js/jquery.hjt.hnav.js"></script>
<?php
}

if($LoadMENU_Navv){?>
<script type="text/javascript" src="<?php echo $template_path ?>/js/jquery.hjt.navv.js"></script>
<script type="text/javascript">
<?php
foreach($mnucfg as $menu_name => $menu) {
	if($menu['type'] == "navv"){ ?>
	jQuery(document).ready(function(){
			jQuery('.mnu_<?php echo $menu_name;?>').dropDownMenu({
					speed: <?php echo $menu['animation_speed']; ?>,
					effect: '<?php echo $menu['animation_effect']; ?>'
      });
      var navHeight = jQuery('ul.navv > li').outerHeight()
      jQuery('ul.navv').parent('div').css('height', navHeight)
	});
<?php	 
	}
}
?>
</script>  
<?php } ?>