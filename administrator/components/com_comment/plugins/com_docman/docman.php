<?php
/**
 * @package    CComment
 * @author     DanielDimitrov <daniel@compojoom.com>
 * @date       24.01.15
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Class ccommentComponentDocmanPlugin
 *
 * @since  5.0
 */
class ccommentComponentDocmanPlugin extends ccommentComponentPlugin
{
	/**
	 * With this function we determine if the comment system should be executed for this
	 * content Item
	 *
	 * @return bool
	 */
	public function isEnabled()
	{
		$config = ccommentConfig::getConfig('com_docman');
		$row = $this->row;

		$contentIds = $config->get('basic.exclude_content_items', array());
		$include = $config->get('basic.include_categories', 0);
		$categories = $config->get('basic.categories', array());

		/* doc id excluded ? */
		if (in_array((($row->id == 0) ? -1 : $row->id), $contentIds))
			return false;

		/* category included or excluded ? */
		$result = in_array((($row->docman_category_id == 0) ? -1 : $row->docman_category_id), $categories);
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
	 * @return boolean
	 */
	public function isSingleView()
	{
		$input = JFactory::getApplication()->input;

		return ($input->getCmd('option') == 'com_docman' && $input->getCmd('view') == 'document');
	}

	/**
	 * Show the readon button
	 *
	 * @return bool
	 */
	public function showReadOn()
	{
		$config = ccommentConfig::getConfig('com_docman');

		return $config->get('layout.show_readon');
	}

	/**
	 * Creates a link to single view of a docman document
	 *
	 * @param   int   $contentId  - the docman document id
	 * @param   int   $commentId  - the comment id
	 * @param   bool  $xhtml      - whether or not we should generate a xhtml link
	 *
	 * @return string|void
	 */
	public function getLink($contentId, $commentId = 0, $xhtml = true)
	{
		if (!class_exists('Koowa'))
		{
			return;
		}

		$comment = '';

		if ($commentId)
		{
			$comment = '#!/ccomment-comment=' . $commentId;
		}

		$page = 'all';

		if (JFactory::getApplication()->isSite())
		{
			$active = JFactory::getApplication()->getMenu()->getActive();

			if ($active && $active->component === 'com_docman')
			{
				$page = $active->id;
			}
		}

		$item = KObjectManager::getInstance()->getObject('com://admin/docman.model.documents')
			->id($contentId)
			->page($page)
			->fetch();

		$link = JRoute::_(
				sprintf(
					'index.php?option=com_docman&view=document&alias=%s&category_slug=%s&Itemid=%d',
				$item->alias, $item->category_slug, $item->itemid), $xhtml
			) . $comment;

		return $link;
	}

	/**
	 * Returns the id of the author of an item
	 *
	 * In this case the contentId = authorID
	 *
	 * @param   int  $contentId  - the document id
	 *
	 * @return mixed
	 */
	public function getAuthorId($contentId)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('created_by')->from('#__docman_documents')
			->where('docman_document_id = ' . $db->q($contentId));

		$db->setQuery($query, 0, 1);
		$author = $db->loadObject();

		if ($author)
		{
			return $author->created_by;
		}

		return false;
	}

	/**
	 * In this case we will get the name out of the users table
	 * Jomsocial is just replicating + augmenting the data in their tables
	 *
	 * @param   array  $ids  - array with document ids
	 *
	 * @return mixed
	 */
	public function getItemTitles($ids)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('docman_document_id as id, title')->from('#__docman_documents')
			->where('docman_document_id IN (' . implode(',', $ids) . ')');

		$db->setQuery($query);

		return $db->loadObjectList('id');
	}
}
