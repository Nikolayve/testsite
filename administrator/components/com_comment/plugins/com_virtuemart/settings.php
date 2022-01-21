<?php
/**
 * @author     Daniel Dimitrov <daniel@compojoom.com>
 * @date       18.02.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

if (!class_exists('VmConfig'))
{
	$file = JPATH_ADMINISTRATOR . '/components/com_virtuemart/helpers/config.php';

	if (file_exists($file))
	{
		require $file;
	}
	else
	{
		throw new Exception('No Virtuemart installed!');
	}
}

/**
 * Class ccommentComponentVirtuemartSettings
 *
 * @since  4.0
 */
class CcommentComponentVirtuemartSettings extends ccommentComponentSettings
{
	/**
	 * categories option list used to display the include/exclude category list in setting
	 * must return an array of objects (id,title)
	 *
	 * @return array() - associative array (id, title)
	 */
	public function getCategories()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$config = VmConfig::loadConfig();
		$query->select(
			array(
				$db->qn('virtuemart_category_id') . ' AS id',
				$db->qn('category_name') . 'AS title'
			)
		)->from($db->qn('#__virtuemart_categories_' . $config->get('vmlang', 'en_gb')));
		$db->setQuery($query);
		$catoptions = $db->loadObjectList();

		return $catoptions;
	}
}
