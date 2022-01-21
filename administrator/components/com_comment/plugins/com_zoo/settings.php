<?php
/**
 * @author Daniel Dimitrov - compojoom.com
 * @date: 13.05.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');


class ccommentComponentZooSettings extends ccommentComponentSettings
{
	public function getCategories() {
		$db = JFactory::getDBO();

		$query = $db->getQuery(true);
		$query->select('id, name as title');
		$query->from('#__zoo_category');
		$query->where('published = 1');
		$query->order('name ASC');

		$db->setQuery($query);
		$options = $db->loadObjectList();

		return $options;
	}
}