<?php
/**
 * @package    - com_comment
 * @author     : DanielDimitrov - compojoom.com
 * @date: 28.03.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

class ccommentComponentPhocadownloadPlugin extends ccommentComponentPlugin
{

	/**
	 * With this function we determine if the comment system should be executed for this
	 * content Item
	 * @return bool
	 */
	public function isEnabled()
	{
		$config = ccommentConfig::getConfig('com_phocadownload');
		$row = $this->row;

		$contentIds = $config->get('basic.exclude_content_items', array());
		$include = $config->get('basic.include_categories', 0);
		$categories = $config->get('basic.categories', array());

		/* doc id excluded ? */
		if (in_array((($row->id == 0) ? -1 : $row->id), $contentIds))
			return false;

		/* category included or excluded ? */
		$result = in_array((($row->catid == 0) ? -1 : $row->catid), $categories);
		if (($include && !$result) || (!$include && $result))
			return false; /* include and not found OR exclude and found */

		return true;
	}

	/**
	 * This function decides whether to show the comments
	 * in an article/item or to show the readmore link
	 *
	 * If it returns true - the comments are shown
	 * If it returns false - the setShowReadon function will be called
	 *
	 * @param int - the content/item id
	 *
	 * @return boolean
	 */
	public function isSingleView()
	{
		return (JFactory::getApplication()->input->getCmd('view') == 'file');
	}

	/**
	 * @return bool
	 */
	public function showReadOn()
	{
		$config = ccommentConfig::getConfig('com_phocadownload');
		return $config->get('layout.show_readon');
	}

	public function getLink($contentId, $commentId = 0, $xhtml = true)
	{
		$comment = '';
		if ($commentId)
		{
			$comment = '#!/ccomment-comment=' . $commentId;
		}

		if (isset($this->row->alias))
		{
			$alias = ':' . $this->row->alias;
		}
		else
		{
			$alias = ':' . $this->getAlias($contentId);
		}

		$itemId = '&Itemid=' . ccommentHelperUtils::getItemid('com_phocadownload');

		$link = JRoute::_('index.php?option=com_phocadownload&view=file&id=' . $contentId . $alias . $itemId, $xhtml) . $comment;

		return $link;
	}

	private function getAlias($id)
	{
		$db = JFactory::getDBO();
		$query = 'SELECT alias FROM ' . $db->qn('#__phocadownload')
			. ' WHERE id = ' . $db->Quote($id);
		$db->setQuery($query, 0, 1);
		return $db->loadObject()->alias;
	}

	/**
	 * Returns the id of the author of an item
	 *
	 * In this case the contentId = authorID
	 *
	 * @param int $contentId
	 *
	 * @return mixed
	 */
	public function getAuthorId($contentId)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('userid')->from('#__phocadownload')
			->where('id = ' . $db->q($contentId));

		$db->setQuery($query, 0, 1);
		$author = $db->loadObject();
		if ($author)
		{
			return $author->userid;
		}
		return false;
	}

	/**
	 * In this case we will get the name out of the users table
	 * Jomsocial is just replicating + augmenting the data in their tables
	 *
	 * @param $ids
	 *
	 * @return mixed
	 */
	public function getItemTitles($ids)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('id,title')->from('#__phocadownload')
			->where('id IN (' . implode(',', $ids) . ')');

		$db->setQuery($query);
		return $db->loadObjectList('id');
	}
}