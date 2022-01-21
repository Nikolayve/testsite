<?php
/**
 * @author Daniel Dimitrov - compojoom.com
 * @date: 26.04.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');


class ccommentComponentJoomgallerySettings extends ccommentComponentSettings
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
		$query->select('cid as id, name as title');
		$query->from('#__joomgallery_catg');
		$query->where('published = 1');
		// exclude the root category
		$query->where('cid > 1');
		$query->order('title');

		$db->setQuery($query);
		$options = $db->loadObjectList();

		return $options;
	}

}