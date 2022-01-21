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

class ccommentComponentJDownloadsPlugin extends ccommentComponentPlugin
{

	/**
	 * With this function we determine if the comment system should be executed for this
	 * content Item
	 * @return bool
	 */
	public function isEnabled()
	{
		$config = ccommentConfig::getConfig('com_jdownloads');
		$row = $this->row;

		$contentIds = $config->get('basic.exclude_content_items', array());
		$include = $config->get('basic.include_categories', 0);
		$categories = $config->get('basic.categories', array());

		/* doc id excluded ? */
		if (in_array((($row->file_id == 0) ? -1 : $row->file_id), $contentIds))
			return false;

		/* category included or excluded ? */
		$result = in_array((($row->cat_id == 0) ? -1 : $row->cat_id), $categories);
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
		return (JFactory::getApplication()->input->getCmd('view') == 'viewdownload');
	}

	/**
	 * @return bool
	 */
	public function showReadOn()
	{
		$config = ccommentConfig::getConfig('com_jdownloads');
		return $config->get('layout.show_readon');
	}

	public function getLink($contentId, $commentId = 0, $xhtml = true)
	{
		$comment = '';
		if ($commentId)
		{
			$comment = '#!/ccomment-comment=' . $commentId;
		}

		if (isset($this->row->cat_id))
		{
			$catid = $this->row->cat_id;
		}
		else
		{
			$catid = $this->getCat($contentId);
		}

		$itemId = '&Itemid=' . ccommentHelperUtils::getItemid('com_jdownloads');

		$link = JRoute::_('index.php?option=com_jdownloads&view=viewdownload&catid='.$catid.'&cid=' . $contentId . $alias . $itemId, $xhtml) . $comment;

		return $link;
	}

	private function getCat($contentId) {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('cat_id')->from('#__jdownloads_files')
			->where('file_id = ' . $contentId);

		return $db->loadObject()->cat_id;
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
		$query->select('created_id')->from('#__jdownloads_files')
			->where('id = ' . $db->q($contentId));

		$db->setQuery($query, 0, 1);
		$author = $db->loadObject();
		if ($author)
		{
			return $author->created_id;
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
		$query->select('file_id AS id, file_title AS title')->from('#__jdownloads_files')
			->where('file_id IN (' . implode(',', $ids) . ')');

		$db->setQuery($query);
		return $db->loadObjectList('id');
	}

	public function getPageId()
	{
		return $this->row->file_id;
	}
}