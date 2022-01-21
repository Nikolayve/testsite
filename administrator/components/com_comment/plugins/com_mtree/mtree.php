<?php
/**
 * @author     Daniel Dimitrov - compojoom.com
 * @date: 19.02.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

class ccommentComponentMTreePlugin extends ccommentComponentPlugin
{

	/**
	 * With this function we determine if the comment system should be executed for this
	 * content Item
	 * @return bool
	 */
	public function isEnabled()
	{
		$config = ccommentConfig::getConfig('com_mtree');
		$row = $this->row;

		$contentIds = $config->get('basic.exclude_content_items', array());
		$categories = $config->get('basic.categories', array());
		$include = $config->get('basic.include_categories', 0);
		if (in_array((($row->id == 0) ? -1 : $row->id), $contentIds))
		{
			return false;
		}

		$result = false;

		$catid = $row->cat_id;
		if ($catid)
		{
			$result = in_array($catid, $categories);
		}

		if (($include && !$result) || (!$include && $result))
		{
			return false;
		}
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
		$input = JFactory::getApplication()->input;
		$option = $input->getCmd('option', '');
		$task = $input->getCmd('task', '');

		return ($option == 'com_mtree' && $task == 'viewlink' );
	}

	/**
	 * This function determines whether to show the comment count or not
	 * @return bool
	 */
	public function showReadOn()
	{
		$config = ccommentConfig::getConfig('com_mtree');
		return $config->get('layout.show_readon');
	}

	public function getLink($contentId, $commentId = 0, $xhtml = true)
	{
		$add = '';
		// if we have a row - use the info in it

		if ($commentId)
		{
			$add = "#!/ccomment-comment=$commentId";
		}

		$url = JRoute::_('index.php?option=com_mtree&task=viewlink'.
			"&link_id=" . $contentId
			. '&Itemid=' . ccommentHelperUtils::getItemid('com_mtree')
			. $add, $xhtml);

		return $url;
	}

	/**
	 * Returns the id of the author of an item
	 *
	 * @param int $contentId
	 *
	 * @return mixed
	 */
	public function getAuthorId($contentId)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('user_id')->from('#__mt_links')
			->where('link_id = ' . $db->q($contentId));

		$db->setQuery($query, 0, 1);
		$author = $db->loadObject();
		if ($author)
		{
			return $author->user_id;
		}
		return false;
	}

	public function getItemTitles($ids)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('link_id as id,link_name as title')->from('#__mt_links')
			->where('link_id IN (' . implode(',', $ids) . ')');

		$db->setQuery($query);
		return $db->loadObjectList('id');
	}
}