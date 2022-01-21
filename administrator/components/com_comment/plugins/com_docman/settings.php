<?php
/**
 * @package    CComment
 * @author     DanielDimitrov <daniel@compojoom.com>
 * @date       24.01.15
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Class ccommentComponentDocmanSettings
 *
 * @since  5.0
 */
class ccommentComponentDocmanSettings extends ccommentComponentSettings
{
	/**
	 * Gets the categories for the backend settings
	 *
	 * @return mixed
	 */
	public function getCategories()
	{
		$db = JFactory::getDBO();

		$query = $db->getQuery(true);
		$query->select('docman_category_id as id, title');
		$query->from('#__docman_categories');
		$query->where('enabled = 1');
		$query->order('title ASC');

		$db->setQuery($query);
		$options = $db->loadObjectList();

		return $options;
	}
}
