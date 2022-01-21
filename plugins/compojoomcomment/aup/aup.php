<?php
/**
 * @package    Ccomment
 * @author     DanielDimitrov <daniel@compojoom.com>
 * @date       10.06.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Class PlgCompojoomCommentAup
 *
 * @package  Ccomment
 * @since    5
 */
class PlgCompojoomCommentAup extends JPlugin
{
	/**
	 * The constructor
	 *
	 * @param   object  &$subject  - the subject
	 * @param   array   $params    - the params
	 */
	public function __construct(&$subject, $params)
	{
		$this->loadLanguage('plg_compojoomcomment_aup', JPATH_ADMINISTRATOR);
		parent::__construct($subject, $params);
	}

	/**
	 * Ads points after comment
	 *
	 * @param   string  $context  -  the plugin context
	 * @param   object  $data     -  the comment
	 *
	 * @return  void
	 */
	public function onAfterCommentSave($context, $data)
	{
		$api_AUP = JPATH_SITE . '/components/com_alphauserpoints/helper.php';

		if ( file_exists($api_AUP))
		{
			require_once $api_AUP;
			$plugin = ccommentHelperUtils::getPlugin($data->component);
			$ids = array($data->contentid);
			$title = $plugin->getItemTitles($ids);
			$note = JText::sprintf('PLG_COMPOJOOMCOMMENT_AUP_MADE_COMMENT',
				JRoute::_('index.php?option=com_comment&task=comment.gotocomment&id=' . $data->id),
				$title[$data->contentid]->title
			);

			$keyReference = AlphaUserPointsHelper::buildKeyreference('plgaup_ccomment_comment', $data->contentid);
			AlphaUserPointsHelper::newpoints('plgaup_ccomment_comment', '', $keyReference, $note);
		}
	}

	/**
	 * OnAfterCommentVote
	 *
	 * @param   object   $data  - the comment
	 * @param   boolean  $mode  - the type of vote +1/-1
	 *
	 * @return  void
	 */
	public function onAfterCommentVote($data, $mode)
	{
		$api_AUP = JPATH_SITE . '/components/com_alphauserpoints/helper.php';

		if ( file_exists($api_AUP))
		{
			require_once $api_AUP;
			$type = ($mode === 1) ? 'plgaup_ccomment_positive_vote' : 'plgaup_ccomment_negative_vote';
			$plugin = ccommentHelperUtils::getPlugin($data->component);
			$ids = array($data->contentid);
			$title = $plugin->getItemTitles($ids);
			$note = JText::sprintf('PLG_COMPOJOOMCOMMENT_AUP_VOTED_ON_COMMENT',
				JRoute::_('index.php?option=com_comment&task=comment.gotocomment&id=' . $data->id),
				$title[$data->contentid]->title
			);

			$keyReference = AlphaUserPointsHelper::buildKeyreference($type, $data->contentid);
			AlphaUserPointsHelper::newpoints($type, '', $keyReference, $note);
		}
	}
}
