<?php
/**
 * @package    com_hotspots
 * @author     DanielDimitrov <daniel@compojoom.com>
 * @date       19.05.2015
 *
 * @copyright  Copyright (C) 2008 - 2015 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');
$data = $displayData;

JHtml::stylesheet('media/plg_k2_hotspots/css/css.css');
JHtml::script('https://maps.googleapis.com/maps/api/js?v=3.exp');
JHtml::script('media/plg_k2_hotspots/js/hotspot.js');

JFactory::getDocument()->addScriptDeclaration(
	'
google.maps.event.addDomListener(window, "load", function(){initializeHotspotMap(' . json_encode($data['center']) . ', ' . json_encode($data['hotspot']) . ')});'
);
?>
<div>
	<?php if(isset($data['hotspot']->id)): ?>
		<input id="hs-delete" name="hotspot[delete]" value="1" type="checkbox" /> Delete current Hotspot entry
	<?php endif; ?>
</div>
<div>
	<input id="hs-street" name="hotspot[street]" value="<?php echo $data['street']; ?>" placeholder="street"/>
</div>
<div>
	<input id="hs-town" name="hotspot[town]" value="<?php echo $data['city']; ?>" placeholder="City"/>
</div>
<div>
	<input id="hs-plz" name="hotspot[plz]" value="<?php echo $data['zip']; ?>" placeholder="Zip"/>
</div>
<div>
	<input id="hs-country" name="hotspot[country]" value="<?php echo $data['country']; ?>" placeholder="Country"/>
</div>
<div>
	<input id="hs-sticky" name="hotspot[params][sticky]" type="checkbox" value="1"
		   checked="<?php echo(isset($data['hotspot']->params) ? $data['hotspot']->params->get('sticky') : '1') ?>"/>
	Sticky marker
</div>
<div>
	Drag the marker or click on the map to update the location
	<div id="hotspot-map">hotspot map</div>
	<div>
		<input id="hotspot_lat" name="hotspot[gmlat]" value="<?php echo $data['lat']; ?>" placeholder="Latitude"/>
		<input id="hotspot_lng" name="hotspot[gmlng]" value="<?php echo $data['lng']; ?>" placeholder="Longitude"/>
	</div>
