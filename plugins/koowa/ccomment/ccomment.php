<?php
/**
 * @package    Com_Comment
 * @author     DanielDimitrov <daniel@compojoom.com>
 * @date       23.01.2015
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Class PlgKoowaCcomment
 *
 * @since  5.0
 */
class PlgKoowaCcomment extends JPlugin
{
	/**
	 * This will render the comments in docman
	 *
	 * @param   string  $context  - the context
	 * @param   object  &$row     - the docman document
	 * @param   object  &$params  - any params
	 * @param   int     $page     - the page
	 *
	 * @return bool|mixed|string|void
	 */
	public function onContentAfterDisplay($context, &$row, &$params, $page = 0)
	{
		if (in_array($context, array('com_docman.document', 'com_docman.list')))
		{
			JLoader::discover('ccommentHelper', JPATH_ROOT . '/components/com_comment/helpers');

			return ccommentHelperUtils::commentInit('com_docman', $row);
		}

		return '';
	}
}
