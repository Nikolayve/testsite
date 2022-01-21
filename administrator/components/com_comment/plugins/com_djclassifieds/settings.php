<?php
/**
 * @author     Daniel Dimitrov <daniel@compojoom.com>
 * @date       03.02.14
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');


/**
 * Class CcommentComponentDJClassifiedsSettings
 *
 * @since  5.0.5
 */
class CcommentComponentDJClassifiedsSettings extends ccommentComponentSettings
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

		$query->select('id, name AS title')
			->from('#__djcf_categories')
			->where('published=1');

		$db->setQuery($query);
		$cats = $db->loadObjectList();

		return $cats;
	}
}
