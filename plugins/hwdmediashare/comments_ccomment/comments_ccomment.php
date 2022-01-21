<?php
/**
 * @author Daniel Dimitrov - compojoom.com
 * @date: 01.05.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

// Import hwdMediaShare remote library
hwdMediaShareFactory::load('remote');

/**
 * hwdMediaShare framework files class
 *
 * @package hwdMediaShare
 * @since   0.1
 */
class plgHwdmediashareComments_ccomment
{


	/**
	 * Returns the hwdMediaShareFiles object, only creating it if it
	 * doesn't already exist.
	 *
	 * @return  hwdMediaShareFiles A hwdMediaShareFiles object.
	 * @since   0.1
	 */
	public static function getInstance()
	{
		static $instance;

		if (!isset ($instance))
		{
			$c = 'plgHwdmediashareComments_ccomment';
			$instance = new $c;
		}

		return $instance;
	}

	/**
	 * Method to add a file to the database
	 *
	 * @since   0.1
	 **/
	public function getComments()
	{
		// Load hwdMediaShare config
		$input = JFactory::getApplication()->input;

		$extension = $input->getCmd('option');
		$view = $input->getCmd('view');

		// Check we are viewing a media item
		if (!($extension == "com_hwdmediashare" && $view == "mediaitem"))
		{
			return false;
		}


		$plugin = JPluginHelper::getPlugin('hwdmediashare', 'comments_ccomment');

		// Die if plugin not avaliable
		if (isset($plugin->params))
		{
			$params = new JRegistry($plugin->params);
		}
		else
		{
			$params = new JRegistry();
		}

		JLoader::discover('ccommentHelper', JPATH_ROOT . '/components/com_comment/helpers');

		if(!JLoader::load('ccommentHelperUtils')) {
			// no CComment on the site
			return false;
		}

		// Get a row instance.
		JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_hwdmediashare/tables');
		$table = JTable::getInstance('Media', 'hwdMediaShareTable');


		// Attempt to load the row.
		if ($table->load($input->getCmd('id')))
		{
			// Convert the JTable to a clean JObject.
			$properties = $table->getProperties(1);
			$item = JArrayHelper::toObject($properties, 'JObject');

			return ccommentHelperUtils::commentInit('com_hwdmediashare', $item, $params);

		}
		else if ($error = $table->getError())
		{
			//@TODO: Add suitable error handling
			//$this->setError($error);
			//jexit();
		}

		return false;
	}
}