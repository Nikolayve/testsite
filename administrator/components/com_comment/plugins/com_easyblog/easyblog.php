<?php
/**
 * @package    Com_Comment
 * @author     Daniel Dimitrov <daniel@compojoom.com>
 * @date       27.08.15
 *
 * @copyright  Copyright (C) 2008 - 2015 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Class CcommentComponentEasyblogPlugin
 *
 * @since  4.0
 */
class CcommentComponentEasyblogPlugin extends ccommentComponentPlugin
{
	/**
	 * With this function we determine if the comment system should be executed for this
	 * content Item. Always returns true since EasyBlog takes care of only calling our component when necessary
	 *
	 * @return bool
	 */
	public function isEnabled()
	{
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
		$input     = JFactory::getApplication()->input;
		$option    = $input->getCmd('option', '');
		$view      = $input->getCmd('view', '');
		$contentId = $input->getCmd('id', 0);

		return $view == 'entry' && $option == 'com_easyblog' && $contentId;
	}

	/**
	 * This function determines whether to show the comment count or not
	 *
	 * @return bool
	 */
	public function showReadOn()
	{
		$config = ccommentConfig::getConfig('com_easyblog');

		return $config->get('layout.show_readon');
	}

	/**
	 * Creates a link to the easyblog item
	 *
	 * @param   int        $contentId  - the easyblog id
	 * @param   int        $commentId  - the comment id
	 * @param   bool|true  $xhtml      - whether we should generate a xhtml link or not
	 *
	 * @return string
	 */
	public function getLink($contentId, $commentId = 0, $xhtml = true)
	{
		require_once JPATH_ADMINISTRATOR . '/components/com_easyblog/includes/easyblog.php';

		$anchors = $commentId ? "#!/ccomment-comment=$commentId" : '';
		$url     = EasyBlogRouter::getRoutedURL('index.php?option=com_easyblog&view=entry&id=' . $contentId, $xhtml, true) . $anchors;

		return $url;
	}

	/**
	 * Returns the id of the author of an item
	 *
	 * @param   int  $contentId  - the easyblog id
	 *
	 * @return mixed
	 */
	public function getAuthorId($contentId)
	{
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('created_by')->from('#__easyblog_post')
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
	 * Get the title of the post
	 *
	 * @param   array  $ids  - array with easyblog ids
	 *
	 * @return mixed
	 */
	public function getItemTitles($ids)
	{
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('id,title')->from('#__easyblog_post')
			->where('id IN (' . implode(',', $ids) . ')');

		$db->setQuery($query);

		return $db->loadObjectList('id');
	}
}
