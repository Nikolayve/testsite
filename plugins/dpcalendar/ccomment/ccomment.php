<?php
/**
 * @package    - com_comment
 * @author     : DanielDimitrov - compojoom.com
 * @date: 13.05.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Direct Access to this location is not allowed.');

class plgDPCalendarCcomment extends JPlugin
{

	public function onEventAfterDisplay($item, $content) {
		JLoader::discover('ccommentHelper', JPATH_ROOT . '/components/com_comment/helpers');
		return ccommentHelperUtils::commentInit('com_dpcalendar', $item);
	}

}