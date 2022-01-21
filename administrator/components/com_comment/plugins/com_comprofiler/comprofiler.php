<?php
/**
 * @package    Com_Comment
 * @author     DanielDimitrov <daniel@compojoom.com>
 * @date       29.03.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Class ccommentComponentComprofilerPlugin
 *
 * @since  5.2
 */
class CcommentComponentComprofilerPlugin extends CcommentComponentPlugin
{
	/**
	 * With this function we determine if the comment system should be executed for this
	 * content Item
	 *
	 * @return bool
	 */
	public function isEnabled()
	{
		$config = ccommentConfig::getConfig('com_comprofiler');
		$row = $this->row;

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
		$input = JFactory::getApplication()->input;
		$option = $input->getCmd('option', '');
		$view = $input->getCmd('view', '');

		$task = strtolower($input->getCmd('task'));

		return ($option == 'com_comprofiler'
			&& ($view == 'userprofile' || $task == 'userprofile')
		);
	}

	/**
	 * This function determines whether to show the comment count or not
	 *
	 * @return bool
	 */
	public function showReadOn()
	{
		$config = ccommentConfig::getConfig('com_comprofiler');

		return $config->get('layout.show_readon');
	}

	/**
	 * Creates a link to a CB user profile
	 *
	 * @param   int   $contentId  - the item id
	 * @param   int   $commentId  - the comment id
	 * @param   bool  $xhtml      - should we generate a xhtml link?
	 *
	 * @return string
	 */
	public function getLink($contentId, $commentId = 0, $xhtml = true)
	{
		$add = '';

		if ($commentId)
		{
			$add = "#!/ccomment-comment=$commentId";
		}

		$url = JRoute::_('index.php?option=com_comprofiler&task=userprofile&user=' . $contentId . '&Itemid=' . ccommentHelperUtils::getItemid('com_comprofiler'), $xhtml) . $add;

		return $url;
	}

	/**
	 * $contentid is the id of the user's profile we are currently on
	 *
	 * @param   int  $contentId  - the content id
	 *
	 * @return mixed
	 */
	public function getAuthorId($contentId)
	{
		return $contentId;
	}

	/**
	 * Get the title of the comment
	 * In this case we either get the username or the realname for the profiles
	 *
	 * @param   array  $ids  - ids of items
	 *
	 * @return mixed
	 */
	public function getItemTitles($ids)
	{
		$config = ccommentConfig::getConfig('com_comprofiler');
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		// Use realname or username
		if ($config->get('layout.use_name'))
		{
			$query->select('id,name AS title');
		}
		else
		{
			$query->select('id,username AS title');
		}

		$query->from('#__users')
			->where('id IN (' . implode(',', $ids) . ')');

		$db->setQuery($query);

		return $db->loadObjectList('id');
	}
}
