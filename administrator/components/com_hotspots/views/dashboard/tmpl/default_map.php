<?php
/**
 * @package    com_hotspots
 * @author     DanielDimitrov <daniel@compojoom.com>
 * @date       30.07.14
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');


function getHotspots()
{
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);

	$query->select(
		'm.id AS hotspots_id, m.gmlat as latitude,
							m.gmlng as longitude, m.*'
	)
		->from('#__hotspots_marker as m')
		->leftJoin('#__categories AS c ON m.catid = c.id')
		->order('m.created DESC');
	$db->setQuery($query, 0, 25);

	return $db->loadObjectList();
}

function prepareHotspots($hotspots)
{
	$json = array();

	foreach ($hotspots as $hotspot)
	{
		$json['hotspots'][$hotspot->catid][$hotspot->id] = HotspotsHelperUtils::prepareHotspot($hotspot);
	}

	return json_encode($json);
}

$doc = JFactory::getDocument();
$doc->addScript(HotspotsHelperUtils::getGmapsUrl());

JHtml::_('behavior.framework', true);
$this->setMootoolsLocale();

JHTML::_('script', 'media/com_hotspots/js/fixes.js');
JHTML::_('script', 'media/com_hotspots/js/spin/spin.js');
JHTML::_('script', 'media/com_hotspots/js/libraries/infobubble/infobubble.js');
JHTML::_('script', 'media/com_hotspots/js/moo/Class.SubObjectMapping.js');
JHTML::_('script', 'media/com_hotspots/js/moo/Map.js');
JHTML::_('script', 'media/com_hotspots/js/moo/Map.Extras.js');
JHTML::_('script', 'media/com_hotspots/js/moo/Map.Marker.js');
JHTML::_('script', 'media/com_hotspots/js/moo/Map.InfoBubble.js');
JHTML::_('script', 'media/com_hotspots/js/moo/Map.Geocoder.js');
JHTML::_('script', 'media/com_hotspots/js/helpers/helper.js');

JHTML::_('script', 'media/com_hotspots/js/core.js');
JHTML::_('script', 'media/com_hotspots/js/sandbox.js');

JHTML::_('script', 'media/com_hotspots/js/modules/hotspot.js');
JHTML::_('script', 'media/com_hotspots/js/modules/latesthotspots.js');

$doc = JFactory::getDocument();
HotspotsHelperUtils::getJsLocalization();
$domready = "window.addEvent('domready', function(){ \n";

$domready .= 'hotspots = new compojoom.hotspots.core();';
$domready .= 'var latesthotspots = ' . prepareHotspots(getHotspots()) . ';';
$domready .= HotspotsHelperUtils::getJSVariables();
$domready .= "
hotspots.addSandbox('map_canvas', hotspots.DefaultOptions);
hotspots.addModule('latesthotspots', latesthotspots, hotspots.DefaultOptions);
hotspots.startAll();";
$domready .= "});";

$doc->addScriptDeclaration($domready);
JHtml::script('JTOOLBAR_EDIT');
?>

<div class="mod_hotspots">
	<div style="height: 300px;">

		<div id="map_canvas" class="map_canvas"
		     style="height:300px;"></div>

	</div>
</div>