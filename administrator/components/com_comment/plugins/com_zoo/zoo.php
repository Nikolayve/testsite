<?php
/**
 * @package    CComment
 * @author     DanielDimitrov <daniel@compojoom.com>
 * @date       25.03.14
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Class CcommentComponentZooPlugin
 *
 * @since  5.0
 */
class CcommentComponentZooPlugin extends ccommentComponentPlugin
{
	/**
	 * With this function we determine if the comment system should be executed for this
	 * content Item
	 *
	 * @return bool
	 */
	public function isEnabled()
	{
		$config = ccommentConfig::getConfig('com_zoo');
		$row = $this->row;

		$contentIds = $config->get('basic.exclude_content_items', array());
		$include = $config->get('basic.include_categories', 0);
		$categories = $config->get('basic.categories', array());

		/* doc id excluded ? */
		if (in_array((($row->id == 0) ? -1 : $row->id), $contentIds))
		{
			return false;
		}

		$cats = $row->getRelatedCategoryIds();
		$result = array_intersect($cats, $categories);

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
	 * @return boolean
	 */
	public function isSingleView()
	{
		$input = JFactory::getApplication()->input;

		return ($input->getCmd('option') == 'com_zoo' && $input->getCmd('task') == 'item' && $this->row->id == $input->getInt('item_id'));
	}

	/**
	 * Determines wheter to show the "write comment" link or not
	 *
	 * @return bool
	 */
	public function showReadOn()
	{
		$config = ccommentConfig::getConfig('com_zoo');

		return $config->get('layout.show_readon');
	}

	/**
	 * Creates a proper SEF link to zoo
	 *
	 * @param   int   $contentId  - the zoo item id
	 * @param   int   $commentId  - the comment id
	 * @param   bool  $xhtml      - whether we should output a xhtml link or not
	 *
	 * @return string
	 */
	public function getLink($contentId, $commentId = 0, $xhtml = true)
	{
		$comment = '';

		if ($commentId)
		{
			$comment = '#!/ccomment-comment=' . $commentId;
		}

		$itemId = '&Itemid=' . ccommentHelperUtils::getItemid('com_zoo');

		$link = JRoute::_('index.php?option=com_zoo&task=item&item_id=' . $contentId . $itemId, $xhtml) . $comment;

		return $link;
	}

	/**
	 * Returns the id of the author of an item
	 *
	 * In this case the contentId = authorID
	 *
	 * @param   int  $contentId  - the zoo item id
	 *
	 * @return mixed
	 */
	public function getAuthorId($contentId)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('created_by')->from('#__zoo_item')
			->where('id = ' . $db->q($contentId));

		$db->setQuery($query, 0, 1);
		$author = $db->loadObject();

		if ($author)
		{
			return $author->created_by;
		}

		return false;
	}

	/**
	 * Get the title for the ids
	 *
	 * @param   array  $ids  - the ids to search for
	 *
	 * @return mixed
	 */
	public function getItemTitles($ids)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('id,name as title')->from('#__zoo_item')
			->where('id IN (' . implode(',', $ids) . ')');

		$db->setQuery($query);

		return $db->loadObjectList('id');
	}
}
