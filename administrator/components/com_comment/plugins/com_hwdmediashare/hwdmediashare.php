<?php
/**
 * @author     Daniel Dimitrov <daniel@compojoom.com>
 * @date       19.02.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Class ccommentComponentHwdmediasharePlugin
 *
 * @since  4.0
 */
class CcommentComponentHwdmediasharePlugin extends CcommentComponentPlugin
{
	/**
	 * With this function we determine if the comment system should be executed for this
	 * content Item
	 *
	 * @return bool
	 */
	public function isEnabled()
	{
		$config = ccommentConfig::getConfig('com_hwdmediashare');
		$row    = $this->row;

		$contentIds = $config->get('basic.exclude_content_items', array());

		/* doc id excluded ? */
		if (in_array((($row->id == 0) ? -1 : $row->id), $contentIds))
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
		$input  = JFactory::getApplication()->input;
		$option = $input->getCmd('option', '');
		$view   = $input->getCmd('view', '');

		return ($option == 'com_hwdmediashare'
			&& $view == 'mediaitem'
		);
	}

	/**
	 * This function determines whether to show the comment count or not
	 *
	 * @return bool
	 */
	public function showReadOn()
	{
		$config = ccommentConfig::getConfig('com_hwdmediashare');

		return $config->get('layout.show_readon');
	}

	/**
	 * Get the link to the hwd item
	 *
	 * @param   int   $contentId  - the multimedia id
	 * @param   int   $commentId  - the comment id
	 * @param   bool  $xhtml      - xhtml link
	 *
	 * @return string - the link
	 */
	public function getLink($contentId, $commentId = 0, $xhtml = true)
	{
		$add = '';

		// If we have a row - use the info in it
		if ($this->row)
		{
			$alias = $this->row->alias;
		}
		else
		{
			$alias = $this->getAlias($contentId);
		}

		if ($alias)
		{
			$alias = ':' . $alias;
		}

		if ($commentId)
		{
			$add = "#!/ccomment-comment=$commentId";
		}

		$url = JRoute::_(
			'index.php?option=com_hwdmediashare&view=mediaitem&id=' . $contentId . $alias . '&Itemid=' . ccommentHelperUtils::getItemid('com_hwdmediashare')
			. $add,
			$xhtml
		);

		return $url;
	}

	/**
	 * Get the alias in case we don't have a $row object
	 *
	 * @param   int  $id  -  the id of the media item
	 *
	 * @return mixed
	 */
	private function getAlias($id)
	{
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select($db->qn('alias'))->from('#__hwdms_media')->where('id = ' . $db->q($id));
		$db->setQuery($query);

		return $db->loadObject()->alias;
	}

	/**
	 * Returns the id of the author of an item
	 *
	 * @param   int  $contentId  - the multimedia item id
	 *
	 * @return mixed
	 */
	public function getAuthorId($contentId)
	{
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('created_user_id')->from('#__hwdms_media')
			->where('id = ' . $db->q($contentId));

		$db->setQuery($query, 0, 1);
		$author = $db->loadObject();

		if ($author)
		{
			return $author->created_user_id;
		}

		return false;
	}

	/**
	 * Get the Item title
	 *
	 * @param   array  $ids  - array with ids
	 *
	 * @return mixed
	 */
	public function getItemTitles($ids)
	{
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('id,title')->from('#__hwdms_media')
			->where('id IN (' . implode(',', $ids) . ')');

		$db->setQuery($query);

		return $db->loadObjectList('id');
	}
}
