<?php
/**
 * @package    com_hotspots
 * @author     DanielDimitrov <daniel@compojoom.com>
 * @date       06.05.2015
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

JHTML::_('behavior.framework', true);
JHTML::_('behavior.tooltip');
JHTML::_('stylesheet', 'media/com_hotspots/css/hotspots.css');

$doc = JFactory::getDocument();

JHTML::_('script', HotspotsHelperUtils::getGmapsUrl());
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

JHTML::_('script', 'media/com_hotspots/js/modules/hotspot/hotspot.js');
JHTML::_('script', 'media/com_hotspots/js/modules/menu.js');

JHTML::_('script', 'media/com_hotspots/js/helpers/slide.js');
JHTML::_('script', 'media/com_hotspots/js/helpers/tab.js');


$addressArray = $displayData['addressArray'];
$params       = $displayData['params'];
$hotspot      = $displayData['hotspot'];
$frontend     = $displayData['frontend'];
$width        = $params->get('map_width', '') ? $params->get('map_width', '') . 'px' : '100%';

$settings                     = HotspotsHelperUtils::getJSVariables(true);
$settings['mapStartZoom']     = $params->get('zoom', 12);
$settings['mapStartPosition'] = $hotspot['latitude'] . ',' . $hotspot['longitude'];
$settings['centerType']       = 2;
$settings['categories']       = array();

HotspotsHelperUtils::getJsLocalization();
$herodocHotspot  = json_encode($hotspot);
$herodocSettings = json_encode($settings);
$domready        = <<<ABC
window.addEvent('domready', function(){

hotspots = new compojoom.hotspots.core();
hotspots.DefaultOptions = $herodocSettings;
var hotspot = $herodocHotspot;

	hotspots.addSandbox('map_canvas', hotspots.DefaultOptions);

	hotspots.addModule('hotspot', hotspot, hotspots.DefaultOptions);
	hotspots.addModule('menu',hotspots.DefaultOptions);
	hotspots.startAll();
});
ABC;

if ($params->get('sw_tabs', 0))
{
	$swTabTemplate = $params->get('sw_tabs_template', 'default');
	$tabResponsive = 0;
	$tabTarget = '';

	switch ($swTabTemplate)
	{
		case 'responsive':
			$swcontainerClass = '.responsive-tabs';
			$swIdReplace = 'tablist1-panel';
			$tabHeader = 'tablist1-tab';
			$tabResponsive = 'tab';
			break;
		case 'accordion':
			$swcontainerClass = '.accordion';
			$swIdReplace = 'swtab';
			$tabHeader = 'tab';
			$tabTarget = ' a';
			break;
		case 'hashtabs':
			$swcontainerClass = '.tab-container';
			$swIdReplace = 'tab';
			$tabHeader = 'swtabs';
			$tabTarget = ' a';
			break;
		case 'default':
		default:
			$swcontainerClass = '#tabContainer';
			$swIdReplace = 'tabpage_';
			$tabHeader = 'tabHeader_';
			break;
	}
}



$doc->addScriptDeclaration($domready);
?>

<div id="hotspots" class="plg_content_hotspots hotspots">
	<?php if (count($addressArray)) : ?>
		<div id="hotspots-address">
			Address: <?php echo implode(',', $addressArray); ?>
		</div>
	<?php endif; ?>
	<div id="map_cont" style="height: <?php echo $params->get('map_height', 400); ?>px; width:  <?php echo $width; ?>">

		<?php require_once $frontend . '/views/hotspot/tmpl/default_menu.php'; ?>

		<div id="map_canvas" class="map_canvas"
			style="height: <?php echo $params->get('map_height', 400); ?>px; width: <?php echo $width; ?>">

		</div>

	</div>
</div>

<?php if ($params->get('sw_tabs', 0)) : ?>
<script type="text/javascript">
	jQuery(window).load(function(){
			var hOnPage = jQuery('<?php echo $swcontainerClass; ?> .hotspots');

			if (hOnPage.length) {
				var id = hOnPage.parent().attr('id').replace('<?php echo $swIdReplace; ?>', ''),
					triggered = false;
				jQuery('#<?php echo $tabHeader; ?>' + id + '<?php echo $tabTarget; ?>').on('click', function () {
					if (!triggered) {
						google.maps.event.trigger(hotspots.sandbox.mapObj, 'resize');
						hotspots.sandbox.setCenter();
						triggered = true;
					}
				});
				<?php if ($tabResponsive) : ?>
					id = hOnPage.parent().attr('class').match(/\w*tabpage\w*/)[0].replace('tabpage', '');
					jQuery('.<?php echo $tabResponsive; ?>' + id).on('click', function () {
						if (!triggered) {
							google.maps.event.trigger(hotspots.sandbox.mapObj, 'resize');
							hotspots.sandbox.setCenter();
							triggered = true;
						}
					});
				<?php endif; ?>
			}
	});
</script>
<?php endif; ?>