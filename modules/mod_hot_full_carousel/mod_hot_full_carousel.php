<?php
/*------------------------------------------------------------------------
# "Hot Full Carousel" Joomla module
# Copyright (C) 2013 HotJoomlaTemplates.com. All Rights Reserved.
# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
# Author: HotJoomlaTemplates.com
# Website: http://www.hotjoomlatemplates.com
-------------------------------------------------------------------------*/
 
// no direct access
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

// Path assignments
$mosConfig_absolute_path = JPATH_SITE;
$mosConfig_live_site = JURI :: base();
if(substr($mosConfig_live_site, -1)=="/") { $mosConfig_live_site = substr($mosConfig_live_site, 0, -1); }
 
// get parameters from the module's configuration
$enablejQuery = $params->get('enablejQuery','1');
$noConflict = $params->get('noConflict','1');
$linkNewWindow = $params->get('linkNewWindow','0');

for ($loop = 1; $loop <= 20; $loop += 1) {
$enableSlide[$loop] = $params->get('enableSlide'.$loop,'');
}

for ($loop = 1; $loop <= 20; $loop += 1) {
$image[$loop] = $params->get('image'.$loop,'');
}

for ($loop = 1; $loop <= 20; $loop += 1) {
$imageAlt[$loop] = $params->get('imageAlt'.$loop,'');
}

for ($loop = 1; $loop <= 20; $loop += 1) {
$imageHeading[$loop] = $params->get('imageHeading'.$loop,'');
}

for ($loop = 1; $loop <= 20; $loop += 1) {
$imageText[$loop] = $params->get('imageText'.$loop,'');
}

for ($loop = 1; $loop <= 20; $loop += 1) {
$imageLinkArray[$loop] = $params->get('image'.$loop.'link','');
}

for ($loop = 1; $loop <= 20; $loop += 1) {
$imageTitleArray[$loop] = $params->get('image'.$loop.'title','');
}

$animSpeed = $params->get('animSpeed','1000');
$pauseTime = $params->get('pauseTime','5000');
$easing = $params->get('easing','easeOutExpo');
$moduleWidth = $params->get('moduleWidth','700');
$moduleHeight = $params->get('moduleHeight','480');
$textAreaWidth = $params->get('textAreaWidth','50');
$textAreaLeft = $params->get('textAreaLeft','24');
$textAreaTop = $params->get('textAreaTop','80');
$textAreaPadding = $params->get('textAreaPadding','1');
$borderRadius = $params->get('borderRadius','10');
$boxBgColor = $params->get('boxBgColor','255,255,255');
$boxTransparency = $params->get('boxTransparency','0.8');
$textColor = $params->get('textColor','#000000');
$headingSize = $params->get('headingSize','24');
$textSize = $params->get('textSize','12');
$navArrows = $params->get('navArrows','10');
$arrowBottom = $params->get('arrowBottom','10');
$arrowSide = $params->get('arrowSide','10');
$arrowLeftText = $params->get('arrowLeftText','Previous');
$arrowRightText = $params->get('arrowRightText','Next');
$navBg = $params->get('navBg','0,0,0');
$navTransparency = $params->get('navTransparency','0.7');
$navBgHover = $params->get('navBgHover','#89051C');
$navTextColor = $params->get('navTextColor','#FFFFFF');
$navWidth = $params->get('navWidth','80');
$navHeight = $params->get('navHeight','40');
$navTextSize = $params->get('navTextSize','20');
$navBorderRadius = $params->get('navBorderRadius','20');
$responsiveMode = $params->get('responsiveMode','0');

require(JModuleHelper::getLayoutPath('mod_hot_full_carousel'));