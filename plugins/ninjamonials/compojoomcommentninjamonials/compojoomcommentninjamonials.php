<?php
/**
 * @package - com_comment
 * @author: DanielDimitrov - compojoom.com
 * @date: 29.03.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Direct Access to this location is not allowed.');

JLoader::discover('ccommentHelper', JPATH_ROOT . '/components/com_comment/helpers');

class plgNinjamonialsCompojoomcommentninjamonials extends JPlugin {

	public function afterTestimonialsDisplaySingle($row, $params) {
		echo ccommentHelperUtils::commentInit('com_ninjamonials', $row, $params);
	}

	public function afterTestimonialsDisplayAll($row, $params) {
		echo ccommentHelperUtils::commentInit('com_ninjamonials', $row, $params);
	}
}
