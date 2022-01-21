<?php
/**
 * @package    CComment
 * @author     DanielDimitrov <daniel@compojoom.com>
 * @date       06.05.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Direct Access to this location is not allowed.');

/**
 * Class plgHikashopCcomment
 *
 * @since  5.0
 */
class PlgHikashopCcomment extends JPlugin
{
	/**
	 * Here we will init our comment system
	 *
	 * @param   object  &$view  - the view Object
	 *
	 * @return void
	 */
	public function onHikashopBeforeDisplayView(&$view)
	{
		$appl = JFactory::getApplication();

		// Show readmore for listings
		if ($appl->isSite() && $view->getLayout() == 'listing')
		{
			JLoader::discover('ccommentHelper', JPATH_SITE . '/components/com_comment/helpers');

			foreach ($view->rows as $k => $row)
			{
				// Add the category id as it is normally missing from the $row object
				if (empty($row->category_id))
				{
					$row->category_id = $view->element->category_id;
				}

				$comments = ccommentHelperUtils::commentInit('com_hikashop', $row);
				$view->rows[$k]->extraData->afterProductName[] = $comments;
			}
		}

		// Show comment form for products
		if ($appl->isSite() && $view->getLayout() == 'show')
		{
			JLoader::discover('ccommentHelper', JPATH_SITE . '/components/com_comment/helpers');
			$comments = ccommentHelperUtils::commentInit('com_hikashop', $view->element);
			$view->element->extraData->bottomEnd[] = $comments;
		}
	}
}
