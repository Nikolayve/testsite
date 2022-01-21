<?php
/**
 * @author Daniel Dimitrov - compojoom.com
 * @date: 18.02.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');


class ccommentComponentMtreeSettings extends ccommentComponentSettings
{
	/**
	 * categories option list used to display the include/exclude category list in setting
	 * must return an array of objects (id,title)
	 *
	 * @return array() - associative array (id, title)
	 */
	public function getCategories()
	{
		$database = JFactory::getDBO();

		$query 	= "SELECT cat_id as id, cat_name as title"
			. "\n FROM ".$database->qn('#__mt_cats')
			. "\n WHERE cat_published = 1"
			. "\n ORDER BY ordering"
		;
		$database->setQuery( $query );

		$catoptions = $database->loadObjectList();

		return $catoptions;
	}

}