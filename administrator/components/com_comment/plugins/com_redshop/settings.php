<?php
/**
 * @author Daniel Dimitrov - compojoom.com
 * @date: 24.05.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');


class ccommentComponentRedshopSettings extends ccommentComponentSettings
{
	public function getCategories() {
		$db = JFactory::getDBO();

		$query = $db->getQuery(true);
		$query->select('category_id AS id, category_name AS title');
		$query->from('#__redshop_category');
		$query->where('published = 1');
		$query->order('category_name ASC');

		$db->setQuery($query);
		$options = $db->loadObjectList();

		return $options;
	}
}