<?php
/**
 * @package    Com_Comment
 * @author     DanielDimitrov <daniel@compojoom.com>
 * @date       02.04.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Class ccommentImportKomento
 *
 * @since 4.0
 */
class ccommentImportKomento extends ccommentImporter
{
	/**
	 * Check if the table exists
	 *
	 * @return mixed
	 */
	public function exist()
	{
		return ccommentHelperTable::existsTable('#__komento_comments');
	}

	/**
	 * Import the comments from komento
	 *
	 * @return bool
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
				$db->qn('comment'),
				$db->qn('published'),
				$db->qn('importtable'),
				$db->qn('importid'),
				$db->qn('importparentid')
			)
			) . ')';

		$select->select(
			array(
				$db->qn('cid'),
				$db->qn('component'),
				$db->qn('ip'),
				$db->qn('created_by'),
				$db->qn('created'),
				$db->qn('name'),
				$db->qn('email'),
				$db->qn('comment'),
				$db->qn('published'),
				$db->q('kommento_comments'),
				$db->qn('id'),
				$db->qn('parent_id')
			)
		)->from('#__komento_comments');

		$db->setQuery($query . $select->__toString());

		if ($db->execute())
		{
			$this->updateParent();

			return true;
		}

		return false;
	}
}
