<?php
/**
 * @author Daniel Dimitrov - compojoom.com
 * @date: 18.02.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');


class ccommentComponentHikashopSettings extends ccommentComponentSettings
{
	function getCategories() {
		$database = JFactory::getDBO();

		$sectoptions = array();
		$query = "SELECT category_id AS id, category_name AS title"
			. "\n FROM " . $database->qn('#__hikashop_category')
			. "\n WHERE category_published = 1"
			. "\n ORDER BY category_ordering"
		;
		$database->setQuery($query);
		$sectoptions = $database->loadObjectList();

		return $sectoptions;
	}
}