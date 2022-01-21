<?php
/**
 * @author Daniel Dimitrov - compojoom.com
 * @date: 19.02.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

class ccommentComponentDocimportPlugin extends ccommentComponentPlugin
{

	/**
	 * With this function we determine if the comment system should be executed for this
	 * content Item
	 * @return bool
	 */
	public function isEnabled()
	{
		$config = ccommentConfig::getConfig('com_docimport');
		$row = $this->row;

		$contentIds = $config->get('basic.exclude_content_items', array());
		$include = $config->get('basic.include_categories', 0);
		$categories = $config->get('basic.categories', array());

		// doc id excluded
		if (in_array((($row->docimport_article_id == 0) ? -1 : $row->docimport_article_id), $contentIds)) {
			return false;
		}

		// category included or excluded
		$result = in_array((($row->docimport_category_id == 0) ? -1 : $row->docimport_category_id), $categories);
		if (($include && !$result) || (!$include && $result)) {
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
	 * @param int - the content/item id
	 * @return boolean
	 */
	public function isSingleView()
	{
		$input = JFactory::getApplication()->input;
		$option = $input->getCmd('option', '');
		$view = $input->getCmd('view', '');

		return ($option == 'com_docimport'
			&& $view == 'article'
		);
	}

	/**
	 * This function determines whether to show the comment count or not
	 * @return bool
	 */
	public function showReadOn()
	{
		$config = ccommentConfig::getConfig('com_docimport');
		return $config->get('layout.show_readon');
	}

	public function getLink($contentId, $commentId = 0, $xhtml = true)
	{
		$add = '';

		if($commentId) {
			$add = "#!/ccomment-comment=$commentId";
		}

		$itemId = '&itemId='.ccommentHelperUtils::getItemid('com_docimport');

		$url = JRoute::_( 'index.php?option=com_docimport&view=article&id='.$contentId . $itemId
			. $add , $xhtml);

		return $url;
	}

	/**
	 * Returns the id of the author of an item
	 *
	 * @param int $contentId
	 *
	 * @return mixed
	 */
	public function getAuthorId($contentId) {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('created_by')->from('#__docimport_articles')
			->where('docimport_article_id = ' . $db->q($contentId));

		$db->setQuery($query, 0, 1);
		$author = $db->loadObject();
		if($author) {
			return $author->created_by;
		}
		return false;
	}

	public function getItemTitles($ids) {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('docimport_article_id AS id,title')->from('#__docimport_articles')
			->where('docimport_article_id IN (' . implode(',', $ids). ')');

		$db->setQuery($query);
		return $db->loadObjectList('id');
	}

	/**
	 * Different component have different names for the id (id, article_id, video_id etc)
	 * That is why we need a function that can reliably return the ID of the item in question
	 *
	 * @return - id of content Item
	 */
	public function getPageId()
	{
		return $this->row->docimport_article_id;
	}
}