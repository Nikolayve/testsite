<?php
/*------------------------------------------------------------------------
# "Hot Maps" Joomla module
# Copyright (C) 2011 HotThemes. All Rights Reserved.
# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
# Author: HotJoomlaTemplates.com
# Website: http://www.hotjoomlatemplates.com
-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// get the document object
$doc =& JFactory::getDocument();

// add your stylesheet
$doc->addStyleSheet( 'modules/mod_hot_maps/tmpl/hot_maps.css' );

?>

<?php if($pre_text) { ?>
<div class="maps_pretext"><?php echo $pre_text ?></div>
<?php } ?>
<iframe height="<?php echo $module_height; ?>" style="border:<?php echo $border; ?>; width:<?php echo $module_width.$module_width_unit; ?>" src="http://maps.google.com/maps?q=<?php

for ($loop = 0; $loop < $keywords_number; $loop += 1) {
	echo $keywords[$loop];
	if($loop!=$keywords_number_1) {
		echo "+";
	}
}

?>&amp;ie=UTF8&amp;view=map&amp;f=q&amp;saddr=<?php

for ($loop = 0; $loop < $keywords_number; $loop += 1) {
	echo $keywords[$loop];
	if($loop!=$keywords_number_1) {
		echo ",+";
	}
}

?>&amp;<?php if($satellite) { ?>t=h&amp;<?php } ?>output=embed"></iframe><?php if($link) { ?><br /><small><a href="http://maps.google.com/maps?q=<?php

for ($loop = 0; $loop < $keywords_number; $loop += 1) {
	echo $keywords[$loop];
	if($loop!=$keywords_number_1) {
		echo "+";
	}
}

?>&amp;ie=UTF8&amp;view=map&amp;f=a&amp;saddr=<?php

for ($loop = 0; $loop < $keywords_number; $loop += 1) {
	echo $keywords[$loop];
	if($loop!=$keywords_number_1) {
		echo ",+";
	}
}

?>&amp;<?php if($satellite) { ?>t=h&amp;<?php } ?>output=embed" style="color:#0000FF;text-align:left"><?php echo $link_text; ?></a></small><?php } ?>
<?php if($post_text) { ?>
<div class="maps_posttext"><?php echo $post_text ?></div>
<?php } ?>

