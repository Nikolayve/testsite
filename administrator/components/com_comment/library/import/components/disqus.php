<?php
/**
 * @package    CComment
 * @author     DanielDimitrov <daniel@compojoom.com>
 * @date       25.11.15
 *
 * @copyright  Copyright (C) 2008 - 2015 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Class CcommentImportDisqus
 *
 * @since  4.0
 */
class CcommentImportDisqus extends CcommentImporter
{
	/**
	 * Check if a disqus.xml file exist for importing
	 *
	 * @return bool
	 */
	public function exist()
	{
		return file_exists(JPATH_ROOT . '/disqus.xml');
	}

	/**
	 * Import the comments
	 *
	 * @return bool
	 */
	public function import()
	{
		$xml = simplexml_load_file(JPATH_ROOT . '/disqus.xml');
		$db = JFactory::getDbo();
		$comments = array();
		$articles = array();

		// Match the threads to joomla categories
		foreach ($xml->thread as $article)
		{
			$attribute = $article->attributes('dsq', true);

			$match = array();
			preg_match('/[0-9]*$/i', $article->id, $match);
			$articles[$attribute->id->__toString()] = $match[0];
		}

		// Create an array with the comments we need
		foreach ($xml->post as $post)
		{
			$dicussArticleId = $post->thread->attributes('dsq', true)->id->__toString();
			$parent = '';

			if ($post->parent && $post->parent->attributes('dsq', true))
			{
				$parent = $post->parent->attributes('dsq', true)->id->__toString();
			}

			$comments[] = '(' . implode(',', array(
					'contentid' => $db->Quote($articles[$dicussArticleId]),
					'component' => $db->Quote('com_content'),
					'ip' => $db->Quote($post->ipAddress->__toString()),
					'date' => $db->Quote(JFactory::getDate($post->createdAt->__toString())->toSql()),
					'name' => $db->Quote($post->author->name->__toString()),
					'email' => $db->Quote($post->author->email->__toString()),
					'comment' => $db->Quote($post->message->__toString()),
					'published' => (isset($post->isSpam) && $post->isSpam == 1) ? 0 : 1,
					'parentid' => $db->Quote($post->parent->__toString()),
					'importtable' => $db->Quote('disqus'),
					'importid' => $db->Quote($post->attributes('dsq', true)->id->__toString()),
					'importparentid' => $db->Quote($parent)
				)
			) . ')';

			// If our array has more than 500 comments, insert them in the the db
			if (count($comments) >= 500)
			{
				$query = $this->createQuery($comments);
				$db->setQuery($query);
				$comments = array();
			}
		}

		// Check if we have comments that we haven't inserted in the database
		if (count($comments))
		{
			$query = $this->createQuery($comments);
			$db->setQuery($query);
			$db->query();
		}

		if ($db->execute())
		{
			$this->updateParent();

			return true;
		}

		return false;
	}

	/**
	 * Create the import query
	 *
	 * @param   array  $comments  - comments to import
	 *
	 * @return string
	 */
	private function createQuery($comments)
	{
		$db = JFactory::getDBO();

		$query = 'INSERT INTO ' . $db->quoteName('#__comment')
			. '(contentid,component,ip,date,name,email,comment,published,parentid,importtable,importid,importparentid)'
			. ' VALUES '
			. implode(',', $comments) . ';';

		return $query;
	}
}

