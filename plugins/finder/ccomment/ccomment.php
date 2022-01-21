<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Finder.Contacts
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_BASE') or die;

require_once JPATH_ADMINISTRATOR . '/components/com_finder/helpers/indexer/adapter.php';

/**
 * Finder adapter for Joomla Contacts.
 *
 * @package     Joomla.Plugin
 * @subpackage  Finder.Contacts
 * @since       2.5
 */
class PlgFinderCcomment extends FinderIndexerAdapter
{
	/**
	 * The plugin identifier.
	 *
	 * @var    string
	 * @since  2.5
	 */
	protected $context = 'Comments';

	/**
	 * The extension name.
	 *
	 * @var    string
	 * @since  2.5
	 */
	protected $extension = 'com_comment';

	/**
	 * The type of content that the adapter indexes.
	 *
	 * @var    string
	 * @since  2.5
	 */
	protected $type_title = 'Comment';

	/**
	 * The table name.
	 *
	 * @var    string
	 * @since  2.5
	 */
	protected $table = '#__comment';

	/**
	 * The field the published state is stored in.
	 *
	 * @var    string
	 * @since  2.5
	 */
	protected $state_field = 'published';

	/**
	 * Load the language file on instantiation.
	 *
	 * @var    boolean
	 * @since  3.1
	 */
	protected $autoloadLanguage = true;



	/**
	 * Method to remove the link information for items that have been deleted.
	 *
	 * This event will fire when contacts are deleted and when an indexed item is deleted.
	 *
	 * @param   string  $context  The context of the action being performed.
	 * @param   JTable  $table    A JTable object containing the record to be deleted
	 *
	 * @return  boolean  True on success.
	 *
	 * @since   2.5
	 * @throws  Exception on database error.
	 */
	public function onFinderAfterDelete($context, $table)
	{
		if ($context == 'com_comment.comment')
		{
			$id = $table->id;
		}
		elseif ($context == 'com_finder.index')
		{
			$id = $table->link_id;
		}
		else
		{
			return true;
		}

		// Remove the items.
		return $this->remove($id);
	}

	/**
	 * Method to index an item. The item must be a FinderIndexerResult object.
	 *
	 * @param   FinderIndexerResult  $item    The item to index as an FinderIndexerResult object.
	 * @param   string               $format  The item format
	 *
	 * @return  void
	 *
	 * @since   2.5
	 * @throws  Exception on database error.
	 */
	protected function index(FinderIndexerResult $item, $format = 'html')
	{
		// Check if the extension is enabled
		if (JComponentHelper::isEnabled($this->extension) == false)
		{
			return;
		}

		$item->setLanguage();

		// Initialize the item parameters.
		$registry = new JRegistry;
		$registry->loadString($item->params);
		$item->params = $registry;

		// Build the necessary route and path information.
		$item->url = $this->getURL($item->id, $this->extension, $this->layout);
		$item->route = $this->getURL($item->id, $this->extension, $this->layout);
		$item->path = $item->route;

		$item->access = 1;

		$item->body = FinderIndexerHelper::prepareContent($item->body);
		$item->summary = $item->body;

		// Handle the contact user name.
		$item->addInstruction(FinderIndexer::META_CONTEXT, 'user');

		// Add the type taxonomy data.
		$item->addTaxonomy('Type', 'Comment');

		// Get content extras.
		FinderIndexerHelper::getContentExtras($item);

		// Index the item.
		$this->indexer->index($item);
	}

	/**
	 * Method to get the URL for the item. The URL is how we look up the link
	 * in the Finder index.
	 *
	 * @param   integer  $id         The id of the item.
	 * @param   string   $extension  The extension the category is in.
	 * @param   string   $view       The view for the URL.
	 *
	 * @return  string  The URL of the item.
	 *
	 * @since   2.5
	 */
	protected function getURL($id, $extension, $view)
	{
		return 'index.php?option=com_comment&task=comment.gotocomment&id=' . $id;
	}

	/**
	 * Method to setup the indexer to be run.
	 *
	 * @return  boolean  True on success.
	 *
	 * @since   2.5
	 */
	protected function setup()
	{

		return true;
	}

	/**
	 * Method to get the SQL query used to retrieve the list of content items.
	 *
	 * @param   mixed  $query  A JDatabaseQuery object or null.
	 *
	 * @return  JDatabaseQuery  A database object.
	 *
	 * @since   2.5
	 */
	protected function getListQuery($query = null)
	{
		$db = JFactory::getDbo();
		// Check if we can use the supplied SQL query.
		$query = $query instanceof JDatabaseQuery ? $query : $db->getQuery(true)
			->select('a.id, a.name AS title, a.date AS start_date, a.comment AS body, a.published as published')
			->select('a.published AS state')
			->select('u.name as user_name')
			->from('#__comment AS a')
			->join('LEFT', '#__users AS u ON u.id = a.userid');

		return $query;
	}
}
