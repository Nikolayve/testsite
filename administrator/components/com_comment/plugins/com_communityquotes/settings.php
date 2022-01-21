<?php
/**
 * @author     Daniel Dimitrov <daniel@compojoom.com>
 * @date       08.07.13
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
class CcommentComponentCommunityQuotesSettings extends ccommentComponentSettings
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
		$query->from('#__categories');
		$query->where('published = 1');
		$query->where('extension = ' . $db->quote('com_communityquotes'));
		$query->order('title ASC');

		$db->setQuery($query);
		$options = $db->loadObjectList();

		return $options;
	}
}
