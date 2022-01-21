<?php
/**
 * @package    Com_Comment
 * @author     Daniel Dimitrov <daniel@compojoom.com>
 * @date       03.02.14
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Class CcommentComponentDJClassifiedsPlugin
 *
 * @since  5.0.5
 */
class CcommentComponentDJClassifiedsPlugin extends ccommentComponentPlugin
{
	/**
	 * With this function we determine if the comment system should be executed for this
	 * content Item
	 *
	 * @return bool
	 */
	public function isEnabled()
	{
		$config = ccommentConfig::getConfig('com_djclassifieds');
		$row = $this->row;

		$contentIds = $config->get('basic.exclude_content_items', array());
		$categories = $config->get('basic.categories', array());
		$include = $config->get('basic.include_categories', 0);

		/* doc id excluded ? */
		if (in_array((($row->id == 0) ? -1 : $row->id), $contentIds))
		{
			return false;
		}

		/* category included or excluded ? */
		$result = in_array((($row->cat_id == 0) ? -1 : $row->cat_id), $categories);

		if (($include && !$result) || (!$include && $result))
		{
			return false; /* include and not found OR exclude and found */
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
		$option = $input->getCmd('option', '');
		$view = $input->getCmd('view', '');

		return ($option == 'com_djclassifieds'
			&& $view == 'item'
		);
	}

	/**
	 * This function determines whether to show the comment count or not
	 *
	 * @return bool
	 */
	public function showReadOn()
	{
		$config = ccommentConfig::getConfig('com_djclassifieds');

		return $config->get('layout.show_readon');
	}

	/**
	 * Creates link to the item
	 *
	 * @param   int   $contentId  - the content id
	 * @param   int   $commentId  - the comment id
	 * @param   bool  $xhtml      - determines if we need a link for content or redirect
	 *
	 * @return string - the link
	 */
	public function getLink($contentId, $commentId = 0, $xhtml = true)
	{
		$add = '';

		if ($commentId)
		{
			$add = "#!/ccomment-comment=$commentId";
		}

		if (isset($this->row))
		{
			$catid = $this->row->cat_id;
			$catname = $this->row->category;
			$name = $this->row->name;
		}
		else
		{
			$catInfo = $this->getCategoryInfo($contentId);
			$catid = $catInfo->id;
			$catname = $catInfo->cat_name;
			$names = $this->getItemTitles(array($contentId));
			$name = $names[$contentId]->title;
		}

		$url = JRoute::_(
			'index.php?option=com_djclassifieds&view=item' .
			'&cid=' . $catid . ':' . JFilterOutput::stringURLSafe($catname) .
			'&id=' . $contentId . ':' . JFilterOutput::stringURLSafe($name) .
			'&Itemid=' . ccommentHelperUtils::getItemid('com_djclassifieds') .
			$add, $xhtml
		);

		return $url;
	}

	/**
	 * Get category id & title
	 *
	 * @param   int  $id  - the item id
	 *
	 * @return mixed
	 */
	private function getCategoryInfo($id)
	{
		$db = JFactory::getDBO();
		$query = 'SELECT c.id, c.name as cat_name FROM ' . $db->qn('#__djcf_categories') . ' AS c'
			. ' LEFT JOIN ' . $db->qn('#__djcf_items') . ' AS i'
			. ' ON i.cat_id = c.id'
			. ' WHERE i.id = ' . $db->Quote($id);
		$db->setQuery($query, 0, 1);

		return $db->loadObject();
	}

	/**
	 * Returns the id of the author of an item
	 *
	 * @param   int  $contentId  - the item id
	 *
	 * @return mixed
	 */
	public function getAuthorId($contentId)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('user_id AS created_by')->from('#__djcf_items')
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
	 * Get the item titles
	 *
	 * @param   array  $ids  - array with ids
	 *
	 * @return mixed
	 */
	public function getItemTitles($ids)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('id,name as title')->from('#__djcf_items')
			->where('id IN (' . implode(',', $ids) . ')');

		$db->setQuery($query);

		return $db->loadObjectList('id');
	}
}
