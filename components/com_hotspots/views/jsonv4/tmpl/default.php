<?php
/**
 * @package    Hotspots
 * @author     DanielDimitrov <daniel@compojoom.com>
 * @date       01.07.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die ('Restricted access');

jimport('joomla.application.module.helper');
$html = array();
$forOutput = array();
$html['hotspots'] = array();

foreach ($this->list['hotspots'] as $key => $hotspot)
{
	$html['hotspots'][$key] = HotspotsHelperHotspot::prepareHotspotForJsonOutput(
			$hotspot,
			$this->users,
			HotspotsHelperHotspot::getCustomFieldsConfig($this->catids)
	);

	// Save lat & lng for later use
	if (isset($this->list['newboundaries']))
	{
		$boundaries['lat'][] = $hotspot->gmlat;
		$boundaries['lng'][] = $hotspot->gmlng;
	}
}

//var_dump($this->list);
//die();
if (isset($this->list['newboundaries']) && count($this->list['hotspots']))
{
	$forOutput['boundaries']['n'] = max($boundaries['lat']);
	$forOutput['boundaries']['e'] = max($boundaries['lng']);
	$forOutput['boundaries']['s'] = min($boundaries['lat']);
	$forOutput['boundaries']['w'] = min($boundaries['lng']);
}

//if (isset($this->list['worldCount']))
//{
//	$forOutput['worldCount'] = $this->list['worldCount'];
//}

$forOutput['total_entries'] = (int) $this->list['viewCount'];
$forOutput['items'] = $html['hotspots'];

//var_dump($forOutput);
//die();
echo json_encode($forOutput);

jexit();
