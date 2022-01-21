<?php
/**
 * @package    Hotspots
 * @author     DanielDimitrov <daniel@compojoom.com>
 * @date       02.07.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Class HotspotsHelperUtils
 *
 * @since  1
 */
class HotspotsHelperUtils
{
	/**
	 * Check if the current user is member of the supplied groups
	 *
	 * @param   array  $groups  - the groups to check against
	 *
	 * @return bool
	 */
	public static function isUserInGroups($groups = array())
	{
		$user = JFactory::getUser();

		$userGroups = $user->getAuthorisedGroups();

		if (array_intersect($groups, $userGroups))
		{
			return true;
		}

		return false;
	}

	/**
	 * Returns a formated date that also takes in account the user timezone
	 *
	 * @param   string  $date  - the date
	 *
	 * @return mixed
	 */
	public static function getLocalDate($date)
	{
		$format = HotspotsHelperSettings::get('date_format', 'Y-m-d H:i:s');
		$formattedDate = JHtml::_('date', $date, $format, true, true);

		return $formattedDate;
	}

	/**
	 * Prepares all variables that we would need in JS
	 *
	 * @param   boolean  $array  - determines if we should return the variables as  array or as a json string
	 *
	 * @return string|array - array with the variables or json string with variables for js
	 */
	public static function getJSVariables($array = false)
	{
		$settings = array();
		$app = JFactory::getApplication();
		$uri = JUri::getInstance();
		$settings['rootUrl'] = JUri::root();

		/**
		 * Don't use Juri::base() as this will be bad for multilanguage sites
		 * @link: https://compojoom.com/blog/entry/ajax-requests-on-multilingual-joomla-websites
		 **/
		$settings['baseUrl'] = $uri->toString(array('scheme', 'user', 'pass', 'host', 'port', 'path'));
		$settings['mapStartPosition'] = HotspotsHelperSettings::get('map_startposition', 'Karlsruhe, Germany');
		$settings['mapStartZoom'] = (int) HotspotsHelperSettings::get('map_startzoom', 4);
		$settings['mapStartZoomSingle'] = (int) HotspotsHelperSettings::get('map_startzoom_single', 15);

		$settings['centerType'] = (int) HotspotsHelperSettings::get('map_centertyp', 1);

		$settings['customUserZoom'] = (int) HotspotsHelperSettings::get('map_center_user_zoom', 15);

		// Center by user's location
		if ($settings['centerType'] === 2 && $app->input->getCmd('view') == 'hotspots')
		{
			$settings['highAccuracy'] = (int) HotspotsHelperSettings::get('high_accuracy', 0);
			$location = HotspotsHelperLocation::getUserLocation();

			if ($location)
			{
				if ($location->latitude && $location->longitude)
				{
					$settings['mapStartPosition'] = $location->latitude . ',' . $location->longitude;

					// Set a higher zoom if we know the user's location
					$settings['mapStartZoom'] = 10;
				}
			}
		}

		$settings['searchZoom'] = (int) HotspotsHelperSettings::get('search_zoom', 14);

		if ($app->isSite() && $app->input->getCmd('view') == 'hotspots')
		{
			$settings['startCat'] = HotspotsHelperSettings::get('hs_startcat', array());
		}

		$settings['mapHeight'] = (int) HotspotsHelperSettings::get('map_height', 500);
		$settings['mapHeightSingle'] = (int) HotspotsHelperSettings::get('map_height_single', 300);
		$settings['startFullscreen'] = (int) HotspotsHelperSettings::get('hs_start_fullscreen', 0);
		$settings['getDirections'] = (int) HotspotsHelperSettings::get('routenplaner', 1);
		$settings['mapBackgroundColor'] = HotspotsHelperSettings::get('map_background', '#E5E3DF');
		$settings['mapType'] = (int) HotspotsHelperSettings::get('map_type', 1);
		$settings['panControl'] = (int) HotspotsHelperSettings::get('panControl', 1);
		$settings['panControlPosition'] = HotspotsHelperSettings::get('panControlPosition', 'TOP_LEFT');
		$settings['zoomControl'] = (int) HotspotsHelperSettings::get('zoomControl', 1);
		$settings['zoomControlStyle'] = HotspotsHelperSettings::get('zoomControlStyle', 'DEFAULT');
		$settings['zoomControlPosition'] = HotspotsHelperSettings::get('zoomControlPosition', 'TOP_LEFT');
		$settings['mapTypeControl'] = (int) HotspotsHelperSettings::get('mapTypeControl', 1);
		$settings['mapTypeControlStyle'] = HotspotsHelperSettings::get('mapTypeControlStyle', 'DEFAULT');
		$settings['mapTypeControlPosition'] = HotspotsHelperSettings::get('mapTypeControlPosition', 'TOP_RIGHT');
		$settings['scaleControl'] = (int) HotspotsHelperSettings::get('scaleControl', 1);
		$settings['streetViewControl'] = (int) HotspotsHelperSettings::get('streetViewControl', 1);
		$settings['streetViewPosition'] = HotspotsHelperSettings::get('streetViewPosition', 'TOP_LEFT');
		$settings['overviewMapControl'] = (int) HotspotsHelperSettings::get('overviewMapControl', 1);
		$settings['scrollwheel'] = (int) HotspotsHelperSettings::get('scrollwheel', 1);
		$settings['styledMaps'] = HotspotsHelperSettings::get('styled_maps', '');
		$settings['userInterface'] = (int) HotspotsHelperSettings::get('user_interface', 1);
		$settings['print'] = (int) HotspotsHelperSettings::get('print_map', 1);
		$settings['resizeMap'] = (int) HotspotsHelperSettings::get('resize_map', 1);
		$settings['mailMap'] = (int) HotspotsHelperSettings::get('mail_map', 1);
		$settings['listLength'] = (int) HotspotsHelperSettings::get('marker_list_length', 20);

		// There is no dedicated setting to the directions right now, but if the
		// menu is not there we should hide them
		$settings['showDirections'] = (int) HotspotsHelperSettings::get('show_marker_directions', 1);
		$settings['showAddress'] = (int) HotspotsHelperSettings::get('show_address', 1);
		$settings['showCountry'] = (int) HotspotsHelperSettings::get('show_address_country', 0);
		$settings['showZoomButton'] = (int) HotspotsHelperSettings::get('show_zoom_button', 0);
		$settings['showAuthor'] = (int) HotspotsHelperSettings::get('show_author', 1);
		$settings['showDate'] = (int) HotspotsHelperSettings::get('show_date', 1);
		$settings['numOfCatsToShow'] = (int) HotspotsHelperSettings::get('number_of_cats_to_show', 4);
		$settings['categoryInfo'] = (int) HotspotsHelperSettings::get('category_info', 4);
		$settings['showMarkerCount'] = (int) HotspotsHelperSettings::get('show_marker_count', 4);
		$settings['weatherLayer'] = (int) HotspotsHelperSettings::get('weather_api', 0);
		$settings['weatherLayerApiKey'] = HotspotsHelperSettings::get('weather_api_key', "");
		$settings['weatherTemperatureUnit'] = HotspotsHelperSettings::get('weather_api_temperature_unit', 'metric');
		$settings['trafficLayer'] = (int) HotspotsHelperSettings::get('traffic_layer', 0);
		$settings['transitLayer'] = (int) HotspotsHelperSettings::get('transit_layer', 0);
		$settings['bicyclingLayer'] = (int) HotspotsHelperSettings::get('bicycling_layer', 0);
		$settings['visualRefresh'] = (int) HotspotsHelperSettings::get('visual_refresh', 1);
		$settings['draggableDirections'] = (int) HotspotsHelperSettings::get('draggable_directions', 1);
		$settings['startClosedMenu'] = (int) HotspotsHelperSettings::get('start_closed_menu', 0);
		$settings['startTab'] = HotspotsHelperSettings::get('tab_opened', 'hotspots');
		$settings['language'] = JFactory::getLanguage()->getTag();
		$settings['tiles'] = (int) HotspotsHelperSettings::get('custom_tiles', 0);

		$settings['categories'] = self::getCategoriesInfo();
		$settings['tabs'] = array();

		if (HotspotsHelperSettings::get('show_tabs_directions', 1))
		{
			$settings['tabs'][] = array(
				'id' => 1,
				'tabName' => '<span class="fa fa-location-arrow"></span> ' . JText::_('COM_HOTSPOTS_DIRECTIONS'),
				'dataName' => 'directions',
				'content' => ''
			);
		}

		if (HotspotsHelperSettings::get('show_tabs_hotspots', 1))
		{
			$settings['tabs'][] = array(
				'id' => 2,
				'tabName' => '<span class="fa fa-map-marker"></span> ' . JText::_('COM_HOTSPOTS_HOTSPOTS'),
				'dataName' => 'hotspots',
				'content' => ''
			);
		}

		if (HotspotsHelperSettings::get('show_tabs_settings', 1))
		{
			$settings['tabs'][] = array(
				'id' => 3,
				'tabName' => '<span class="fa fa-cog"></span> ' . JText::_('COM_HOTSPOTS_SETTINGS'),
				'dataName' => 'settings',
				'content' => ''
			);
		}

		$settings['translations']['enterValidAddress'] = JText::_('COM_HOTSPOTS_PLEASE_ENTER_VALID_ADDRESS');
		$settings['translations']['provideStartAddress'] = JText::_('COM_HOTSPOTS_PLEASE_PROVIDE_START_ADDRESS');
		$settings['translations']['provideEndAddress'] = JText::_('COM_HOTSPOTS_PLEASE_PROVIDE_END_ADDRESS');
		$settings['translations']['myLocation'] = JText::_('COM_HOTSPOTS_MY_LOCATION');

		$override = HotspotsHelperSettings::get('settings_override');

		// Handle the settings override
		if ($override)
		{
			$overrideSettings = explode("\n", $override);

			foreach ($overrideSettings as $value)
			{
				$setting = explode('=', $value);
				$settingValue = trim($setting[1]);

				if (is_numeric($settingValue))
				{
					$settings[trim($setting[0])] = (int) $settingValue;
				}
				else
				{
					$settings[trim($setting[0])] = $settingValue;
				}
			}
		}

		// Return the settings array as it is
		if ($array)
		{
			return $settings;
		}

		return 'hotspots.DefaultOptions = ' . json_encode($settings) . ';';
	}

	/**
	 * Creates a JS file containing our configuration and returns the path to it.
	 *
	 * @return string
	 */
	public static function createJSConfig()
	{
		$vars = self::getJSVariables(true);
		$jsString = 'var HotspotsConfig = ' . json_encode($vars) . ';';
		$md5 = md5(json_encode($vars));

		// If the config doesn't exist, let's create it
		if (!file_exists(JPATH_SITE . '/media/com_hotspots/cache/config/' . $md5 . '.js'))
		{
			JFile::write(JPATH_SITE . '/media/com_hotspots/cache/config/' . $md5 . '.js', $jsString);
		}

		return 'media/com_hotspots/cache/config/' . $md5 . '.js';
	}

	/**
	 * Creates a JSON representation of a marker and assigns it to a js variable
	 *
	 * @param   array  $marker  - the marker
	 *
	 * @return string
	 */
	public static function createJsonMarker($marker)
	{
		$jsString = 'var HotspotsMarker = ' . json_encode($marker) . ';';
		$md5 = md5($jsString);

		// If the config doesn't exist, let's create it
		if (!file_exists(JPATH_SITE . '/media/com_hotspots/cache/marker/' . $md5 . '.js'))
		{
			JFile::write(JPATH_SITE . '/media/com_hotspots/cache/marker/' . $md5 . '.js', $jsString);
		}

		return 'media/com_hotspots/cache/marker/' . $md5 . '.js';
	}

	/**
	 * Prepares the categories for output
	 *
	 * @return mixed
	 */
	public static function getCategoriesInfo()
	{
		$app = JFactory::getApplication();
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		// Get the boundaries first
		$query->select('catid, MIN( gmlat ) AS south, MAX( gmlat ) AS north, MAX( gmlng ) AS east, MIN( gmlng ) AS west')
			->from($db->qn('#__hotspots_marker') . 'AS m')
			->leftJoin($db->qn('#__categories') . 'AS c ON  m.catid = c.id')
			->group('catid');

		$query->where(' m.state = 1');
		$query->where(' c.published = 1');
		$query->where(' c.extension = ' . $db->q('com_hotspots'));

		$nullDate = $query->nullDate();
		$nowDate = $query->Quote(JFactory::getDate()->toSQL());

		$query->where('(m.publish_up = ' . $nullDate . ' OR m.publish_up <= ' . $nowDate . ')');
		$query->where('(m.publish_down = ' . $nullDate . ' OR m.publish_down >= ' . $nowDate . ')');

		if ($app->isSite() && $app->getLanguageFilter())
		{
			$query->where('m.language in (' . $db->quote(JFactory::getLanguage()->getTag()) . ',' . $query->quote('*') . ')');
		}

		$db->setQuery($query);

		$boundaries = $db->loadObjectList('catid');

		// Hack around joomla bug: https://github.com/joomla/joomla-cms/pull/6440
		$categories = JCategories::getInstance('Hotspots', array('blabla'))->get()->getChildren(true);

		$categoryArray = array();

		// Now add the boundaries to the Categories array
		foreach ($categories as $key => $category)
		{
			$readyForOutput = self::prepareCategory($category);

			if (isset($boundaries[$category->id]))
			{
				$readyForOutput->boundaries = $boundaries[$category->id];
			}

			$categoryArray[] = $readyForOutput;
		}

		return $categoryArray;
	}

	/**
	 * Render a list of the categories object
	 *
	 * @param   JCategoryNode  $categories  - the categories object
	 *
	 * @return string
	 */
	public static function renderNestedCategories($categories, $class = '')
	{
		$output = '';
		$output .= '<ul class="' . $class . '">';

		foreach ($categories as $item)
		{
			$params = new JRegistry($item->params);
			$output .= '<li id="hs-category-' . $item->id . '" class="hs-parent-is-' . $item->getParent()->id . '">';
			$output .= '<label class="checkbox hs-checkbox-filter-cats" ' . ($item->description ? 'title="' . JText::_($item->description) . '"' : '') . '>';
			$output .= '<input type="checkbox" value="' . $item->id . '" name="cats" />';
			$output .= '<img src="' . $params->get('icon') . '" alt="cat-icon"/>';
			$output .= JText::_($item->title);
			$output .= '</label>';

			if ($item->hasChildren())
			{
				$output .= self::renderNestedCategories($item->getChildren(), 'hs-children-of-' . $item->id);
			}

			$output .= '</li>';
		}

		$output .= '</ul>';

		return $output;
	}

	/**
	 * Outputs a localisation array for JS
	 *
	 * @return void
	 */
	public static function getJsLocalization()
	{
		$strings = array(
			'COM_HOTSPOTS_JS_DIRECTIONS',
			'COM_HOTSPOTS_GET_DIRECTIONS',
			'COM_HOTSPOTS_ZOOM',
			'COM_HOTSPOTS_TO',
			'COM_HOTSPOTS_FROM',
			'COM_HOTSPOTS_SUBMIT',
			'COM_HOTSPOTS_LOADING_DATA',
			'COM_HOTSPOTS_NO_HOTSPOTS_IN_CATEGORY',
			'COM_HOTSPOTS_MORE_HOTSPOTS',
			'COM_HOTSPOTS_READ_MORE',
			'COM_HOTSPOTS_CANCEL',
			'COM_HOTSPOTS_COULDNT_FIND_LOCATION',
			'COM_HOTSPOTS_ZERO_RESULTS_LOCATION',
			'COM_HOTSPOTS_PRINT',
			'COM_HOTSPOTS_SOMETHING_IS_WRONG',
			'COM_HOTSPOTS_ENTER_FULL_DESCRIPTION',
			'COM_HOTSPOTS_ENTER_SOBI2_ID',
			'COM_HOTSPOTS_ENTER_ARTICLE_ID',
			'COM_HOTSPOTS_GEOLOCATION_NO_SUPPORT',
			'COM_HOTSPOTS_DRAG_ME',
			'COM_HOTSPOTS_THERE_ARE',
			'COM_HOTSPOTS_THERE_IS',
			'COM_HOTSPOTS_EMAIL_THIS_MAP',
			'COM_HOTSPOTS_CLEAR_ROUTE',
			'COM_HOTSPOTS_SEND',
			'COM_HOTSPOTS_CLOSE',
			'COM_HOTSPOTS_SEARCH_RETURNED_NO_RESULTS',
			'COM_HOTSPOTS_POSTED_BY',
			'COM_HOTSPOTS_ON',
			'COM_HOTSPOTS_IN_YOUR_CURRENT_VIEW_THERE_ARE',
			'COM_HOTSPOTS_HOTSPOTS',
			'COM_HOTSPOTS_SEARCH_RESULTS_AROUND_THE_WORLD',
			'COM_HOTSPOTS_SEARCH_RETURNED_NO_RESULTS_IN_THIS_VIEW',
			'COM_HOTSPOTS_SEARCH_IN_YOUR_CURRENT_VIEW_RETURNED',
			'COM_HOTSPOTS_NO_LOCATIONS_IN_CURRENT_VIEW'
		);

		foreach ($strings as $string)
		{
			JText::script($string);
		}
	}

	/**
	 * Prepares a category for output
	 *
	 * @param   object  $category  - the category object
	 *
	 * @return mixed
	 */
	public static function prepareCategory($category)
	{
		$cat = new stdClass;
		$params = new JRegistry($category->params);

		$cat->id = $category->id;
		$cat->cat_name = $category->title;
		$cat->cat_description = $category->description;
		$cat->cat_icon = Juri::root() . $params->get('icon');
		$cat->params = $params;

		return $cat;
	}

	/**
	 * Prepares a hotspot for output
	 *
	 * @param   object  $hotspot  - hotspot object
	 *
	 * @return mixed
	 */
	public static function prepareHotspot($hotspot)
	{
		$descriptionSmall = $hotspot->description_small;

		if (HotspotsHelperSettings::get('marker_allow_plugin', 0) == 1)
		{
			$descriptionSmall = JHTML::_('content.prepare', $descriptionSmall, '');
		}

		$hotspot->postdate = self::getLocalDate($hotspot->created);

		$parameters = new JRegistry;
		$parameters->loadString($hotspot->params);
		$hotspot->params = $parameters;

		$hotspot->link = self::createLink($hotspot);

		$descriptionSmall = self::sef($descriptionSmall);
		$hotspot->description_small = $descriptionSmall;

		return $hotspot;
	}

	/**
	 * When we display the content in the map view the links and images in content
	 * are not run through the sef plugin and that's why in some situations images are not displayed properly
	 * and the links in the short description are not SEF
	 *
	 * TODO: check to see if there is a better way to solve this
	 *
	 * @param   string  $content  - the content for the hotspot
	 *
	 * @return mixed
	 */
	private static function sef($content)
	{
		$app = JFactory::getApplication();

		if ($app->getCfg('sef') == '0')
		{
			return $content;
		}

		// Replace src links
		$base = JURI::base(true) . '/';

		$regex = '#href="index.php\?([^"]*)#m';
		$content = preg_replace_callback($regex, array('self', 'route'), $content);

		// To check for all unknown protocals (a protocol must contain at least one alpahnumeric fillowed by :
		$protocols = '[a-zA-Z0-9]+:';
		$regex = '#(src|href|poster)="(?!/|' . $protocols . '|\#|\')([^"]*)"#m';
		$content = preg_replace($regex, "$1=\"$base\$2\"", $content);

		$regex = '#(onclick="window.open\(\')(?!/|' . $protocols . '|\#)([^/]+[^\']*?\')#m';
		$content = preg_replace($regex, '$1' . $base . '$2', $content);

		// ONMOUSEOVER / ONMOUSEOUT
		$regex = '#(onmouseover|onmouseout)="this.src=([\']+)(?!/|' . $protocols . '|\#|\')([^"]+)"#m';
		$content = preg_replace($regex, '$1="this.src=$2' . $base . '$3$4"', $content);

		// Background image
		$regex = '#style\s*=\s*[\'\"](.*):\s*url\s*\([\'\"]?(?!/|' . $protocols . '|\#)([^\)\'\"]+)[\'\"]?\)#m';
		$content = preg_replace($regex, 'style="$1: url(\'' . $base . '$2$3\')', $content);

		// OBJECT <param name="xx", value="yy"> -- fix it only inside the <param> tag
		$regex = '#(<param\s+)name\s*=\s*"(movie|src|url)"[^>]\s*value\s*=\s*"(?!/|' . $protocols . '|\#|\')([^"]*)"#m';
		$content = preg_replace($regex, '$1name="$2" value="' . $base . '$3"', $content);

		// OBJECT <param value="xx", name="yy"> -- fix it only inside the <param> tag
		$regex = '#(<param\s+[^>]*)value\s*=\s*"(?!/|' . $protocols . '|\#|\')([^"]*)"\s*name\s*=\s*"(movie|src|url)"#m';
		$content = preg_replace($regex, '<param value="' . $base . '$2" name="$3"', $content);

		// OBJECT data="xx" attribute -- fix it only in the object tag
		$regex = '#(<object\s+[^>]*)data\s*=\s*"(?!/|' . $protocols . '|\#|\')([^"]*)"#m';
		$content = preg_replace($regex, '$1data="' . $base . '$2"$3', $content);

		return $content;
	}

	/**
	 * Replaces the matched tags
	 *
	 * @param   array  &$matches  An array of matches (see preg_match_all)
	 *
	 * @return  string
	 */
	protected static function route(&$matches)
	{
		$url = $matches[1];
		$url = str_replace('&amp;', '&', $url);
		$route = JRoute::_('index.php?' . $url);

		return 'href="' . $route;
	}

	/**
	 * Creates a link to single view of a hotspot
	 *
	 * @param   object  $hotspot  - the hotspot object
	 *
	 * @return string $hotspotsLink
	 */
	public static function createLink($hotspot)
	{
		$hotspotsLink = '';

		if (!is_object($hotspot->params))
		{
			$parameters = new JRegistry;
			$parameters->loadString($hotspot->params);
			$hotspot->params = $parameters;
		}

		$globalReadMore = HotspotsHelperSettings::get('hotspot_detailpage', 1);
		$hotspotReadMore = $hotspot->params->get('show_readmore');

		if (($hotspotReadMore == null && $globalReadMore) || $hotspotReadMore)
		{
			// The user wants to link to a 3rd party component and he has also entered the id of the item
			if ($hotspot->params->get('link_to') && $hotspot->params->get('link_to_id'))
			{
				$plugin = JPluginHelper::getPlugin('hotspotslinks', $hotspot->params->get('link_to'));

				if (is_object($plugin))
				{
					JPluginHelper::importPlugin('hotspotslinks', $hotspot->params->get('link_to'));
					$dispatcher = JDispatcher::getInstance();
					$links = $dispatcher->trigger('onCreateLink', array($hotspot->params->get('link_to_id'), $hotspot->id));
					$hotspotsLink = $links[0];
				}
				else
				{
					// If we don't have an object, then let us link to the single view
					$hotspotsLink = self::linkToHotspot($hotspot);
				}
			}
			else
			{
				$hotspotsLink = self::linkToHotspot($hotspot);
			}
		}

		return $hotspotsLink;
	}

	/**
	 * Create a link to single view of a marker.
	 *
	 * @param   object  $hotspot  - the whole marker object
	 *
	 * @return The
	 */
	public static function linkToHotspot($hotspot)
	{
		$catObject = JCategories::getInstance('Hotspots');
		$category = $catObject->get($hotspot->catid);

		if ($category)
		{
			$urlcat = $hotspot->catid . ':' . JFilterOutput::stringURLSafe($category->alias);
		}

		$urlid = $hotspot->hotspots_id . ':' . JFilterOutput::stringURLSafe($hotspot->title);
		$hotspotsLink = JRoute::_(HotspotsHelperRoute::getHotspotRoute($urlid, $urlcat), false);

		return $hotspotsLink;
	}

	/**
	 * Gets the item id for the provided component & view
	 *
	 * @param   string  $component  - the component string
	 * @param   string  $view       - the view name
	 *
	 * @return mixed <int>
	 */
	public static function getItemid($component = '', $view = '')
	{
		$appl = JFactory::getApplication();
		$menu = $appl->getMenu();
		$itemId = '';
		$items = $menu->getItems('component', $component);

		if ($view)
		{
			foreach ($items as $value)
			{
				if (strstr($value->link, 'view=' . $view))
				{
					$itemId = $value->id;
					break;
				}
			}
		}
		else
		{
			$itemId = isset($items[0]) ? $items[0]->id : '';
		}

		return $itemId;
	}

	/**
	 * Creates a correct google maps URL depending on the turned on options
	 *
	 * @return string
	 */
	public static function getGmapsUrl()
	{
		$url = 'https://maps.googleapis.com/maps/api/js';
		$key = HotspotsHelperSettings::get('api_key', '');
		$langConfig = HotspotsHelperSettings::get('map_language', 'map_auto');
		$params = array();

		if ($key)
		{
			$params [] = 'key=' . $key;
		}

		if ($langConfig != 'map_auto')
		{
			if ($langConfig == 'site_lang')
			{
				$languages = JLanguageHelper::getLanguages('lang_code');
				$lang = JFactory::getLanguage()->getTag();
				$jlanguageCode = $languages[$lang]->sef;

				// Let's find out if the current site_lang is supported by google
				$gLang = HotspotsHelperLanguage::mapLang($jlanguageCode);

				if ($gLang)
				{
					$params[] = 'language=' . $gLang;
				}
			}
			else
			{
				$params[] = 'language=' . $langConfig;
			}
		}

		if (count($params))
		{
			$url .= '?' . implode('&amp;', $params);
		}

		return JRoute::_($url, false);
	}

	/**
	 * Function to delete items from an array by value
	 *
	 * @param   array  $array   - the array
	 * @param   mixed  $values  - the values we look for
	 *
	 * @return array
	 */
	public static function deleteByValue($array, $values)
	{
		return array_diff($array, $values);
	}
}
