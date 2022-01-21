<?php
/**
 * @package    CComment
 * @author     DanielDimitrov <daniel@compojoom.com>
 * @date       02.10.15
 *
 * @copyright  Copyright (C) 2008 - 2015 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

require_once JPATH_SITE . '/components/com_jevents/libraries/helper.php';

/**
 * Integration for JEvents
 *
 * Class CcommentComponentJEventsPlugin
 *
 * @since  4.0
 */
class CcommentComponentJEventsPlugin extends CcommentComponentPlugin
{
	/**
	 * Different component have different names for the id (id, article_id, video_id etc)
	 * That is why we need a function that can reliably return the ID of the item in question
	 *
	 * @return - id of content Item
	 */
	public function getPageId()
	{
		return $this->row->rp_id();
	}

	/**
	 * With this function we determine if the comment system should be executed for this
	 * content Item
	 *
	 * @return bool
	 */
	public function isEnabled()
	{
		$config = ccommentConfig::getConfig('com_jevents');
		$row = $this->row;

		$contentIds = $config->get('basic.exclude_content_items', array());
		$categories = $config->get('basic.categories', array());
		$include = $config->get('basic.include_categories', 0);

		/* doc id excluded ? */
		if (in_array(($this->getPageId()), $contentIds))
		{
			return false;
		}

		/*category included or excluded ?*/
		$result = in_array((($row->_catid == 0) ? -1 : $row->_catid), $categories);

		if (($include && !$result) || (!$include && $result))
		{
			return false;
		}

		/* include and not found OR exclude and found */

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
		$task = $input->getCmd('task', '');

		if ($option == 'com_jevents' && $view == 'day')
		{
			return true;
		}

		if ($option == 'com_jevents' && $task == "icalrepeat.detail")
		{
			return true;
		}

		return false;
	}

	/**
	 * This function determines whether to show the comment count or not
	 *
	 * @return bool
	 */
	public function showReadOn()
	{
		$config = ccommentConfig::getConfig('com_jevents');

		return $config->get('layout.show_readon');
	}

	/**
	 * Creates a link to single view of an event
	 *
	 * @param   int   $contentId  - the article id
	 * @param   int   $commentId  - the comment id
	 * @param   bool  $xhtml      - whether or not we should generate a xhtml link
	 *
	 * @return string|void
	 */
	public function getLink($contentId, $commentId = 0, $xhtml = true)
	{
		$add = '';

		// If we have a row - use the info in it

		if ($commentId)
		{
			$add = "#!/ccomment-comment=$commentId";
		}

		if (isset($this->row->alias))
		{
			$alias = ':' . $this->row->alias;
		}
		else
		{
			$alias = ':' . $this->getAlias($contentId);
		}

		$itemId = '&Itemid=' . JEVHelper::getItemid();

		$url = JRoute::_('index.php?option=com_jevents&task=icalrepeat.detail&evid=' . $contentId . $alias . $itemId, $xhtml) . $add;

		return $url;
	}

	/**
	 * Get the alias for the URL
	 *
	 * @param   int  $id  - the id of the event
	 *
	 * @return mixed
	 */
	private function getAlias($id)
	{
		$db = JFactory::getDBO();
		$query = 'SELECT summary FROM ' . $db->qn('#__jevents_vevdetail')
			. ' WHERE evdet_id = ' . $db->Quote($id);
		$db->setQuery($query, 0, 1);

		return $db->loadObject()->summary;
	}

	/**
	 * Returns the id of the author of an item
	 *
	 * @param   int  $contentId  - the event id that we are looking for the author
	 *
	 * @return mixed
	 */
	public function getAuthorId($contentId)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('created_by')->from('#__jevents_vevent AS e')
			->leftJoin('#__jevents_repetition AS r ON r.eventid = e.ev_id')
			->where('r.rp_id = ' . $db->q($contentId));

		$db->setQuery($query, 0, 1);
		$author = $db->loadObject();

		if ($author)
		{
			return $author->created_by;
		}

		return false;
	}

	/**
	 * Get the title of the events
	 *
	 * @param   array  $ids  - array with event ids
	 *
	 * @return mixed
	 */
	public function getItemTitles($ids)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('r.rp_id as id , summary as title')->from('#__jevents_vevdetail AS e')
			->leftJoin('#__jevents_repetition AS r ON r.eventid = e.evdet_id')
			->where('r.rp_id IN (' . implode(',', $ids) . ')');

		$db->setQuery($query);

		return $db->loadObjectList('id');
	}
}
