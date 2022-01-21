<?php
/**
 * @package    CComment
 * @author     DanielDimitrov <daniel@compojoom.com>
 * @date       18.07.15
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Direct Access to this location is not allowed.');


if (!JComponentHelper::getComponent('com_zoo', true)->enabled)
{
	return;
}

// Load ZOO config
jimport('joomla.filesystem.file');

if (!JFile::exists(JPATH_ADMINISTRATOR . '/components/com_zoo/config.php') || !JComponentHelper::getComponent('com_zoo', true)->enabled)
{
	return;
}

require_once JPATH_ADMINISTRATOR . '/components/com_zoo/config.php';

// Make sure App class exists
if (!class_exists('App'))
{
	return;
}

// Get the ZOO App instance
$zoo = App::getInstance('zoo');

// Register event
$zoo->event->dispatcher->connect('item:afterdisplay', array('PlgSystemCcommentzoo', 'afterDisplay'));

// Register and connect events
$zoo->event->register('ApplicationEvent');

/**
 * Class PlgSystemCcommentzoo
 *
 * @since  5.0
 */
class PlgSystemCcommentzoo
{
	/**
	 * Calls the CComment component to render the form
	 *
	 * @param   object  $element  - the zoo item object
	 *
	 * @return void
	 */
	public static function afterDisplay($element)
	{
		$appl = JFactory::getApplication();

		if ($appl->isSite())
		{
			JLoader::discover('ccommentHelper', JPATH_ROOT . '/components/com_comment/helpers');
			$element['html'] .= ccommentHelperUtils::commentInit('com_zoo', $element->getSubject());
		}
	}
}
