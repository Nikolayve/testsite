<?php
/**
 * @package    CComment
 * @author     Daniel Dimitrov <daniel@compojoom.com>
 * @date       02.04.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Class ccommentImportJcomments
 *
 * @package  CComment
 * @since    5.0
 */
class ccommentImportJcomments extends ccommentImporter
{
	/**
	 * Checks if component has db tables
	 *
	 * @return mixed
	 */
	public function exist()
	{
		return ccommentHelperTable::existsTable('#__jcomments');
	}

	/**
	 * Does the actual import
	 *
	 * @return mixed
	 */
	public function import()
	{
		$db = JFactory::getDbo();
		$select = $db->getQuery(true);

		$query = 'INSERT INTO ' . $db->qn('#__comment') . '(' .
			implode(',', array(
				$db->qn('contentid'),
				$db->qn('component'),
				$db->qn('ip'),
				$db->qn('userid'),
				$db->qn('date'),
				$db->qn('name'),
				$db->qn('email'),
				$db->qn('notify'),
				$db->qn('comment'),
				$db->qn('published'),
				$db->qn('deleted'),
				$db->qn('voting_yes'),
				$db->qn('voting_no'),
				$db->qn('importtable'),
				$db->qn('importid'),
				$db->qn('importparentid')
				)
			) . ')';

		$select->select(
			array(
				$db->qn('object_id'),
				$db->qn('object_group'),
				$db->qn('ip'),
				$db->qn('userid'),
				$db->qn('date'),
				$db->qn('name'),
				$db->qn('email'),
				$db->qn('subscribe'),
				$db->qn('comment'),
				$db->qn('published'),
				$db->q(0),
				$db->qn('isgood'),
				$db->qn('ispoor'),
				$db->q('jcomments'),
				$db->qn('id'),
				$db->qn('parent')
			)
		)->from('#__jcomments');

		$db->setQuery($query . $select->__toString());

		if ($db->execute())
		{
			$this->updateParent();

			return true;
		}

		return false;
	}
}
