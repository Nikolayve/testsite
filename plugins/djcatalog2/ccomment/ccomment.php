<?php
/**
 * @package    CComment
 * @author     DanielDimitrov <daniel@compojoom.com>
 * @date       03.02.14
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');


/**
 * Class PlgDJCatalog2Ccomment
 *
 * @since  5.0.5
 */
class PlgDJCatalog2Ccomment extends JPlugin
{
	/**
	 * Initializes the comment system for DJCatalog2 items
	 *
	 * @param   object  $item  - the djcatalog2 object
	 *
	 * @return string
	 */
	public function onAfterDJCatalog2DisplayContent($item)
	{
		JLoader::discover('ccommentHelper', JPATH_ROOT . '/components/com_comment/helpers');

		return ccommentHelperUtils::commentInit('com_djcatalog2', $item);
	}
}
