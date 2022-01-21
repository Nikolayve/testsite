<?php
/**
 * @author Daniel Dimitrov - compojoom.com
 * @date: 18.02.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');


class ccommentComponentJDownloadsSettings extends ccommentComponentSettings
{
	function getCategories() {
		$database = JFactory::getDBO();

		$query = "SELECT cat_id as id, cat_title AS title"
			. "\n FROM " . $database->qn('#__jdownloads_cats')
			. "\n WHERE published = 1"
			. "\n ORDER BY ordering"
		;
		$database->setQuery($query);
		$sectoptions = $database->loadObjectList();

		return $sectoptions;
	}
}