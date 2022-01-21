<?php
/**
 * @package    CComment
 * @author     Daniel Dimitrov <daniel@compojoom.com>
 * @date       26.08.15
 *
 * @copyright  Copyright (C) 2008 - 2015 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

require_once JPATH_ROOT . '/components/com_community/libraries/core.php';

/**
 * Class PlgCommunityCcomment
 *
 * @since  5.0.1
 */
class PlgCommunityCcomment extends CApplications
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
	 * Renders the activity
	 *
	 * @param   object  $act  - the activity object
	 *
	 * @return stdClass
	 */
	public function onCommunityStreamRender($act)
	{
		$actor = CFactory::getUser($act->actor);
		$link = JRoute::_('index.php?option=com_comment&task=comment.gotocomment&id=' . $act->cid);
		$stream = new stdClass;
		$stream->actor = $actor;

		$name = $this->params->get('name', 1) ? $actor->name : $actor->username;

		$title = $act->title;

		// If we don't have a title use the translation of an item
		if (!trim($title))
		{
			$title = JText::_('JOMSOCIAL_ITEM');
		}

		if ($act->app === 'ccomment.addComment')
		{
			$stream->headline = JText::sprintf(
				'JOMSOCIAL_ADDGENERAL_COMMENT',
				$name,
				$link,
				$title
			);
			$stream->message = $act->content;
		}
		elseif ($act->app === 'ccomment.positiveVote')
		{
			$target = CFactory::getUser($act->target);
			$stream->headline = JText::sprintf(
				'JOMSOCIAL_POSITIVEVOTE_COMMENT',
				$name,
				$this->params->get('name', 1) ? $target->name : $target->username,
				$link,
				$title
			);
			$stream->message = $act->content;
		}
		elseif ($act->app === 'ccomment.negativeVote')
		{
			$target = CFactory::getUser($act->target);
			$stream->headline = JText::sprintf(
				'JOMSOCIAL_NEGATIVEVOTE_COMMENT',
				$name,
				$this->params->get('name', 1) ? $target->name : $target->username,
				$link,
				$title
			);
			$stream->message = $act->content;
		}

		return $stream;
	}
}
