<?php
/**
 * @package    Hotspots
 * @author     DanielDimitrov <daniel@compojoom.com>
 * @date       04.07.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');
jimport('joomla.plugin.plugin');

// Load the category for j2.5
jimport('joomla.application.categories');

/**
 * Class plgContentHotspots
 *
 * @since  3.0
 */
class PlgContentHotspots extends JPlugin
{
	private $hotspot = null;
	/**
	 * Constructor
	 *
	 * @param   object  &$subject  - the subject
	 * @param   array   $params    - the params
	 */
	public function __construct(&$subject, $params)
	{
		$jlang = JFactory::getLanguage();
		$jlang->load('com_hotspots', JPATH_SITE, 'en-GB', true);
		$jlang->load('com_hotspots', JPATH_SITE, $jlang->getDefault(), true);
		$jlang->load('com_hotspots', JPATH_SITE, null, true);

		parent::__construct($subject, $params);
	}

	/**
	 * On content prepare event
	 *
	 * @param   string  $context   - the context
	 * @param   object  &$article  - the article object
	 * @param   object  &$params   - the params
	 * @param   int     $page      - the page
	 *
	 * @return bool
	 */
	public function onContentPrepare($context, &$article, &$params, $page = 0)
	{
		// Don't run this plugin when the content is being indexed
		if ($context == 'com_finder.indexer')
		{
			return true;
		}

		if (in_array(
			$context, array(
				'mod_custom.content', 'com_content.article', 'com_content.featured',
				'com_content.category', 'com_k2.item', 'com_k2.itemlist', 'com_jevents')
		))
		{
			// Simple performance check to determine whether bot should process further
			if (strpos($article->text, 'hotspots') === false)
			{
				return true;
			}

			$field = 'text';

			// If we are on the featured page we don't have to execute the plugin if there isn't anything in the introtext
			if ($context == 'com_content.featured' || $context == 'com_content.category')
			{
				$field = 'introtext';
			}

			$settings = array();

			// Expression to search for (hotspots)
			$regex = '/{hotspots\s+(.*?)}/i';

			// Find all instances of plugin and put in $matches for hotspots
			// $matches[0] is full pattern match, $matches[1] contains the settings
			preg_match_all($regex, $article->$field, $matches, PREG_SET_ORDER);

			// No matches, skip this
			if (isset($matches[0][1]))
			{
				$options = explode(' ', $matches[0][1]);

				foreach ($options as $option)
				{
					if (strpos($option, '=') === false)
					{
						continue;
					}

					$option = explode('=', $option);
					$settings[$option[0]] = $option[1];
				}
			}

			if (count($settings))
			{
				if (isset($settings['hotspot']))
				{
					$this->getHotspot($settings['hotspot']);
					$output = $this->mapHotspot();
					$replace = $matches[0][0];
					$article->text = preg_replace("|$replace|", addcslashes($output, '\\$'), $article->text, 1);
				}
			}
		}

		return true;
	}

	/**
	 * Gets the Hotspot data
	 *
	 * @param   int  $id  - the id of the hotspot
	 *
	 * @return mixed
	 */
	private function getHotspot($id)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('m.id as hotspots_id, m.*')
			->from('#__hotspots_marker  AS m')
			->where('m.id = ' . $db->quote($id));

		$db->setQuery($query);
		$this->hotspot = $db->loadObject();

		if ($this->hotspot)
		{
			$category = JCategories::getInstance('Hotspots')->get($this->hotspot->catid);
			$params = new JRegistry($category->params);
			$this->hotspot->cat_icon = $params->get('icon');
		}

		return $this->hotspot;
	}

	/**
	 * Outputs the hotspot map
	 *
	 * @return string
	 */
	public function mapHotspot()
	{
		$frontend = JPATH_BASE . '/components/com_hotspots';
		require_once $frontend . '/includes/defines.php';
		require_once $frontend . '/helpers/route.php';
		JLoader::discover('HotspotsModel', $frontend . '/models');
		JLoader::discover('HotspotsHelper', JPATH_BASE . '/components/com_hotspots/helpers/');

		$width = $this->params->get('map_width', '') ? $this->params->get('map_width', '') . 'px' : '100%';

		JHTML::_('behavior.framework', true);
		JHTML::_('behavior.tooltip');
		JHTML::_('stylesheet', 'media/com_hotspots/css/hotspots.css');

		$doc = JFactory::getDocument();
		$doc->addScript(HotspotsHelperUtils::getGmapsUrl());

		HotspotsHelperUtils::getJsLocalization();
		$domready = "window.addEvent('domready', function(){ \n";
		$this->hotspot = HotspotsHelperUtils::prepareHotspot($this->hotspot);

		$icon = $this->hotspot->cat_icon;

		if ($this->hotspot->params->get('markerimage'))
		{
			$icon = $this->hotspot->params->get('markerimage');
		}

		$hotspot = array(
			'id' => $this->hotspot->id,
			'latitude' => $this->hotspot->gmlat,
			'longitude' => $this->hotspot->gmlng,
			'title' => $this->hotspot->title,
			'icon' => JURI::root() . $icon
		);

		ob_start();

		$settings = HotspotsHelperUtils::getJSVariables(true);

		$settings['mapStartZoom'] = $this->params->get('zoom', 12);
		$settings['mapStartPosition'] = $hotspot['latitude'] . ',' . $hotspot['longitude'];
		$settings['centerType'] = 2;
		$settings['categories'] = array();

		require $frontend . '/views/hotspot/tmpl/default_address.php';
		$address = ob_get_contents();
		ob_end_clean();
		$hotspot['description'] = '<h2>' . $this->hotspot->title . '</h2>'
			. '<div>' . $this->hotspot->description_small . '</div>'
			. '<div>' . preg_replace("@[\\r|\\n|\\t]+@", "", $address) . '</div>';

		$domready .= 'hotspots = new compojoom.hotspots.core();';
		$domready .= 'hotspots.DefaultOptions = ' . json_encode($settings) . ';';
		$domready .= 'var hotspot = ' . json_encode($hotspot) . ';' . "\n";
		$domready .= "
				hotspots.addSandbox('map_canvas', hotspots.DefaultOptions);

				hotspots.addModule('hotspot', hotspot, hotspots.DefaultOptions);
				hotspots.addModule('menu',hotspots.DefaultOptions);
				hotspots.startAll();";
		$domready .= "});";

		$doc->addScriptDeclaration($domready);

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

		$map = '<div id="hotspots" class="plg_content_hotspots hotspots">
                    <div id="map_cont" style="height: ' . $this->params->get('map_height', 400) . 'px; width: ' . $width . '">';
		ob_start();
		require_once $frontend . '/views/hotspot/tmpl/default_menu.php';
		$map .= ob_get_contents();
		ob_end_clean();

		$map .= '<div id="map_canvas" class="map_canvas"
                             style="height: ' . $this->params->get('map_height', 400) . 'px; width: ' . $width . '"></div>

                    </div>
                </div>';

		return $map;
	}
}
