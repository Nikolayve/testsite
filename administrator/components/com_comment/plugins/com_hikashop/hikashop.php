<?php
/**
 * @package    - com_comment
 * @author     : DanielDimitrov - compojoom.com
 * @date: 07.04.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

class ccommentComponentHikashopPlugin extends ccommentComponentPlugin
{

	/**
	 * With this function we determine if the comment system should be executed for this
	 * content Item
	 * @return bool
	 */
	public function isEnabled()
	{
		$config = ccommentConfig::getConfig('com_hikashop');
		$row = $this->row;

		$contentIds = $config->get('basic.exclude_content_items', array());
		$include = $config->get('basic.include_categories', 0);
		$categories = $config->get('basic.categories', array());

		/* doc id excluded ? */
		if (in_array((($row->product_id == 0) ? -1 : $row->product_id), $contentIds))
			return false;

		/* category included or excluded ? */
		$result = in_array((($row->category_id == 0) ? -1 : $row->category_id), $categories);
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
		$input = JFactory::getApplication()->input;
		$control = $input->getCmd('ctrl');
		$task = $input->getCmd('task');
		return ($control == 'product' && $task == 'show');
	}

	/**
	 * @return bool
	 */
	public function showReadOn()
	{
		$config = ccommentConfig::getConfig('com_hikashop');
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
			$alias = $this->row->alias;
		}
		else
		{
			$alias = JFilterOutput::stringURLSafe($this->getAlias($contentId));
		}

		$itemId = '&Itemid=' . ccommentHelperUtils::getItemid('com_hikashop');

		$link = JRoute::_('index.php?option=com_hikashop&ctrl=product&task=show&cid=' . $contentId . '&name=' . $alias . $itemId, $xhtml) . $comment;

		return $link;
	}

	private function getAlias($id)
	{
		$db = JFactory::getDBO();
		$query = 'SELECT product_name AS alias FROM ' . $db->qn('#__hikashop_product')
			. ' WHERE product_id = ' . $db->Quote($id);
		$db->setQuery($query, 0, 1);
		return $db->loadObject()->alias;
	}

	/**
	 * Unfortunatly we don't support this for hikashop - it seems that there is no
	 * created_by field
	 *
	 * @param int $contentId
	 *
	 * @return mixed
	 */
	public function getAuthorId($contentId)
	{
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
		$query->select('product_id AS id, product_name as title')->from('#__hikashop_product')
			->where('product_id IN (' . implode(',', $ids) . ')');

		$db->setQuery($query);
		return $db->loadObjectList('id');
	}

	public function getPageId()
	{
		return $this->row->product_id;
	}

}