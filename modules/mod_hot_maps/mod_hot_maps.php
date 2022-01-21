<?php
/*------------------------------------------------------------------------
# "Hot Maps" Joomla module
# Copyright (C) 2011 HotThemes. All Rights Reserved.
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
$module_width = $params->get('module_width','257');
$module_width_unit = $params->get('module_width_unit','px');
$module_height = $params->get('module_height','172');
$border = $params->get('border','none');
$address = $params->get('address','');
$keywords = explode(" ", $address);
$keywords_number = count($keywords);
$keywords_number_1 = $keywords_number - 1;
$satellite = $params->get('satellite','1');
$link = $params->get('link','1');
$link_text = $params->get('link_text','View Larger Map');
$pre_text = $params->get('pre_text','');
$post_text = $params->get('post_text','');

require(JModuleHelper::getLayoutPath('mod_hot_maps'));
