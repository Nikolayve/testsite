<?php
/**
 * @package    CComment
 * @author     DanielDimitrov <daniel@compojoom.com>
 * @date       22.03.14
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Class modCommentsHelper
 *
 * @since  5.0
 */
class ModCommentsHelper
{
	/**
	 * Gets the comments
	 *
	 * @param   object  $params  - the parameters
	 *
	 * @return mixed
	 */
	public static function getComments($params)
	{
		$components = $params->get('component', array('com_content'));

		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('c.*,u.name AS user_realname, u.username AS user_username')->from('#__comment AS c');
		$query->leftJoin('#__users as u ON c.userid = u.id');

		switch ($params->get('orderby'))
		{
			case 'date':
				$query->order('c.date DESC');
				break;
			case 'voting_yes':
				$query->order('c.voting_yes DESC');
				break;
			case 'voting_no':
				$query->order('c.voting_no DESC');
				break;
			case 'mostrated':
				$query->select(", (c.voting_yes-c.voting_no)/2 AS mostrated");
				$query->where('(c.voting_yes > 0 OR c.voting_no > 0)');
				break;
			case 'mostcommented':
				$query->clear('select');
				$query->select('COUNT(c.id) AS countid, contentid, component, u.name AS user_realname, u.username AS user_username');
				$query->group('contentid');
				$query->order('countid DESC');
				break;
		}

		// Set the time frame if we have one
		if ($params->get('time_frame') != -1)
		{
			$date = JFactory::getdate(time() - 86400 * $params->get('time_frame'));
			$query->where('date >' . $db->q($date->toSql()));
		}

		foreach ($components as $value)
		{
			$componentWhere[] = 'component =' . $db->q($value);
		}

		$query->where(implode(' OR ', $componentWhere));
		$query->where('published = 1');

		$db->setQuery($query, 0, intval($params->get('maxlines', 5)));

		return $db->loadObjectList();
	}

	/**
	 * Gets the titles of the articles for the comments
	 *
	 * @param   string  $components  - component name
	 *
	 * @return array
	 */
	private static function getTitles($components)
	{
		$titles = array();

		foreach ($components as $key => $value)
		{
			$plugin = ccommentHelperUtils::getPlugin($key);
			$titles[$key] = $plugin->getItemTitles($value);
		}

		return $titles;
	}

	/**
	 * Prepares the comments for output
	 *
	 * @param   array   $comments  - array with the comments
	 * @param   object  $params    - the parameters
	 *
	 * @return mixed
	 */
	public static function prepareComments($comments, $params)
	{
		$components = array();
		$userSize = intval($params->get('userSize', 20));
		$conttitlesize = intval($params->get('conttitlesize', 20));
		$commentsize = intval($params->get('commentsize', 40));
		$tooltip = intval($params->get('tooltip', 0));

		$showTitle = $params->get('showconttitle') || $params->get('orderby') == 'mostcommented';

		$tooltipTitleSize = intval($params->get('overtitlesize', 50));
		$tooltipContentSize = intval($params->get('overcontentsize', 100));

		$dateFormat = $params->get('date_format', 'age');

		if ($showTitle)
		{
			foreach ($comments as $comment)
			{
				$components[$comment->component][] = $comment->contentid;
			}

			$titles = self::getTitles($components);
		}

		if ($params->get('orderby') == 'mostcommented')
		{
			foreach ($comments as $key => $comment)
			{
				$conttitle = $titles[$comment->component][$comment->contentid]->title;

				if (JString::strlen($conttitle) > $conttitlesize)
				{
					$conttitle = JString::substr($conttitle, 0, $conttitlesize) . '...';
				}

				$comments[$key]->conttitle = $conttitle;

				$comments[$key]->link = JRoute::_('index.php?option=com_comment&task=comment.gotocomment&contentid=' . $comment->contentid . '&component=' . $comment->component);
			}
		}
		else
		{
			foreach ($comments as $key => $comment)
			{
				$config = ccommentConfig::getConfig($comment->component);
				$name = '';

				if ($comment->name)
				{
					$name = $comment->name;
				}

				$time = ccommentHelperComment::getLocalDate($comment->date, $dateFormat);

				if ($comment->userid)
				{
					if ($config->get('layout.use_name', 0))
					{
						$name = $comment->user_realname;
					}
					else
					{
						$name = $comment->user_username;
					}
				}


				if (JString::strlen($name) > $userSize)
				{
					$name = JString::substr($name, 0, $userSize) . '...';
				}

				if ($showTitle)
				{
					$conttitle = $titles[$comment->component][$comment->contentid]->title;

					if (JString::strlen($conttitle) > $conttitlesize)
					{
						$conttitle = JString::substr($conttitle, 0, $conttitlesize) . '...';
					}

					$comments[$key]->conttitle = $conttitle;
				}

				$comments[$key]->date = $time;
				$comments[$key]->user = $name;
				$comments[$key]->link = JRoute::_('index.php?option=com_comment&task=comment.gotocomment&id=' . $comment->id);

				$commentText = $comment->comment;
				$bbcode = new ccommentHelperBBcode($config);
				$bbcode->setLimit($commentsize);

				$comments[$key]->comment = $bbcode->parse(ccommentHelperUtils::censorText($commentText, $config));

				if ($tooltip)
				{
					$bbcode->SetPlainMode(true);

					if ($showTitle)
					{
						$bbcode->setLimit($tooltipTitleSize);
						$comments[$key]->overlayTitle = $bbcode->parse($comment->conttitle);
					}

					// Try to remove any html from the content
					$bbcode->setLimit($tooltipContentSize);
					$overlayComment = $bbcode->parse($commentText);
					$comments[$key]->overlayComment = $bbcode->UnHTMLEncode(strip_tags($overlayComment));
				}
			}
		}

		return $comments;
	}
}
