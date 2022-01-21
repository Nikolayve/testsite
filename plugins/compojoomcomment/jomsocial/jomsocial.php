<?php
/**
 * @package    CComment
 * @author     DanielDimitrov <daniel@compojoom.com>
 * @date       26.08.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

require_once JPATH_ROOT . '/components/com_community/libraries/core.php';

/**
 * Class plgCompojoomCommentJomSocial
 *
 * @since  5.0
 */
class PlgCompojoomCommentJomSocial extends JPlugin
{
	/**
	 * The constructor
	 *
	 * @param   object  &$subject  - the subject
	 * @param   array   $params    - the params
	 */
	public function __construct(&$subject, $params)
	{
		$this->loadLanguage('plg_compojoomcomment_jomsocial', JPATH_ADMINISTRATOR);
		parent::__construct($subject, $params);
	}

	/**
	 * Executes after we save a comment in the db
	 *
	 * @param   string  $context  - the context we run in
	 * @param   object  $data     - the comment data
	 *
	 * @return void
	 */
	public function onAfterCommentSave($context, $data)
	{
		$userPoints = $this->params->get('userPointsOnComment', 0);
		$activityStream = $this->params->get('activityStreamNewComment', 0);

		if ($userPoints)
		{
			$this->setUserPointsOnAddComment($data);
		}

		if ($activityStream)
		{
			$this->setActivity($data, 'save');
		}
	}

	/**
	 * Executes after a user votes on a comment
	 *
	 * @param   object  $data  - the comment object
	 * @param   int     $mode  - the type of vote +1 or -1
	 *
	 * @return void
	 */
	public function onAfterCommentVote($data, $mode)
	{
		$this->mode = $mode;

		$userPointsOnVote = $this->params->get('userPointsOnVote', 0);
		$activityStreamVoteComment = $this->params->get('activityStreamVoteComment', 0);

		if ($userPointsOnVote)
		{
			$this->setUserPointsOnVoteComment($data);
		}

		if ($activityStreamVoteComment)
		{
			$this->setActivity($data, 'vote');
		}
	}

	/**
	 * Assigns user points on vote
	 *
	 * @param   object  $data  - the comment object
	 *
	 * @return void
	 */
	private function setUserPointsOnVoteComment($data)
	{
		include_once JPATH_ROOT . '/components/com_community/libraries/userpoints.php';

		if ($this->mode == 'no')
		{
			CuserPoints::assignPoint('com_comment.negativeVote', $data->userid);
		}
		else
		{
			CuserPoints::assignPoint('com_comment.positiveVote', $data->userid);
		}
	}

	/**
	 * Assigns points to a user after he has added a comment
	 *
	 * @param   object  $data  - the comment object
	 *
	 * @return void
	 */
	private function setUserPointsOnAddComment($data)
	{
		include_once JPATH_ROOT . '/components/com_community/libraries/userpoints.php';
		CuserPoints::assignPoint('com_comment.addComment', $data->userid);
	}

	/**
	 * Sets activity for the activity stream
	 *
	 * @param   object  $data      - the comment
	 * @param   string  $activity  - type of activity
	 *
	 * @return void
	 */
	private function setActivity($data, $activity)
	{
		// If the comment is not published exit
		if (!$data->published)
		{
			return;
		}

		$title = $this->getTitle($data);
		$target = 0;
		$content = '';

		if ($activity == 'save')
		{
			$cmd = 'ccomment.addComment';

			if ($data->component == 'com_community')
			{
				$activeProfile = CFactory::getActiveProfile();
				$target = $activeProfile->id;
				$title = JText::_('JOMSOCIAL_ADDJOMSOCIAL_COMMENT_TARGET') . JText::_('JOMSOCIAL_WALL');

				if ($data->userid == $target)
				{
					$target = 0;
					$title = JText::_('JOMSOCIAL_ADDJOMSOCIAL_COMMENT_OWN') . JText::_('JOMSOCIAL_WALL');
				}
			}

			$config = ccommentConfig::getConfig($data->component);
			$bbcode = new ccommentHelperBBcode($config);
			$content = $bbcode->parse(CompojoomHtmlString::truncateComplex($data->comment, $this->params->get('commentLength', 100)));
		}
		elseif ($activity == 'vote')
		{
			if ($this->mode === -1)
			{
				$cmd = 'ccomment.negativeVote';
				$target = $data->userid;
			}
			else
			{
				$cmd = 'ccomment.positiveVote';
				$target = (int) $data->userid;
			}
		}

		$act = new stdClass;
		$act->cmd = $cmd;
		$act->actor = JFactory::getUser()->get('id');
		$act->target = $target;
		$act->title = $title;
		$act->content = $content;
		$act->app = $cmd;
		$act->cid = $data->id;

		// Allows to comment on the stream
		$act->comment_type = $cmd;
		$act->comment_id = CActivities::COMMENT_SELF;

		// Allows to like on the stream
		$act->like_type = $cmd;
		$act->like_id = CActivities::LIKE_SELF;

		CFactory::load('libraries', 'activities');
		CActivityStream::add($act);
	}

	/**
	 * Gets the title of the item that we comment on or vote on
	 *
	 * @param   object  $data  -  the comment
	 *
	 * @return string
	 */
	private function getTitle($data)
	{
		$plugin = ccommentHelperUtils::getPlugin($data->component);
		$title = $plugin->getItemTitles(array($data->contentid));

		return $title[$data->contentid]->title;
	}
}
