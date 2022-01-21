<?php
/**
 * @package - com_comment
 * @author: DanielDimitrov - compojoom.com
 * @date: 28.03.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

class ccommentComponentCommunityPlugin extends ccommentComponentPlugin
{

	/**
	 * With this function we determine if the comment system should be executed for this
	 * content Item
	 * @return bool
	 */
	public function isEnabled()
	{
		$config = ccommentConfig::getConfig('com_community');
		$row = $this->row;

		$contentIds = $config->get('basic.exclude_content_items', array());
		$include = $config->get('basic.include_categories', 0);

		/* content ids */
		if (count($contentIds) > 0) {
			$result = in_array((($row->id == 0) ? -1 : $row->id), $contentIds);
			if ($include && $result) {
				return true; /* include and selected */
			}
			if (!$include && $result) {
				return false; /* exclude and selected */
			}
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

		return  (		$option == 'com_community'
			&& 	$view == 'profile'
		);
	}

	/**
	 * No need to show a readon button anywhere through the component for com_community
	 * @return bool
	 */
	public function showReadOn()
	{
		return false;
	}

	public function getLink($contentId, $commentId = 0, $xhtml = true)
	{
		$add = '';
		if($commentId) {
			$add = "#!/ccomment-comment=$commentId";
		}

		require_once(JPATH_ROOT.'/components/com_community/libraries/core.php');
		$url = CRoute::_('index.php?option=com_community&view=profile&userid='.$contentId . $add, $xhtml);
		return $url;
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
	public function getAuthorId($contentId) {
		return $contentId;
	}

	/**
	 * In this case we will get the name out of the users table
	 * Jomsocial is just replicating + augmenting the data in their tables
	 *
	 * @param $ids
	 *
	 * @return mixed
	 */
	public function getItemTitles($ids) {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('id,name AS title')->from('#__users')
			->where('id IN (' . implode(',', $ids). ')');

		$db->setQuery($query);
		return $db->loadObjectList('id');
	}
}