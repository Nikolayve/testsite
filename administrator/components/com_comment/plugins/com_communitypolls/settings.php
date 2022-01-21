<?php
/**
 * @author     Daniel Dimitrov - compojoom.com
 * @date       : 24.05.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Class ccommentComponentCommunitypollsSettings
 *
 * @package  Ccomment
 * @since    5
 */
class ccommentComponentCommunitypollsSettings extends ccommentComponentSettings
{
	/**
	 * Gets the categories for the configuration
	 *
	 * @return array|mixed
	 */
	public function getCategories()
	{
		$db = JFactory::getDBO();

		$query = $db->getQuery(true);
		$query->select('id, title');
		$query->from('#__jcp_categories');
		$query->where('id > 1');
		$query->order('title ASC');

		$db->setQuery($query);
		$options = $db->loadObjectList();

		return $options;
	}
}
