<?php
/**
 * @package    com_comment
 * @author     DanielDimitrov <daniel@compojoom.com>
 * @date       26.08.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

require_once(JPATH_ROOT . '/components/com_community/libraries/core.php');

class plgCommunityCompojoomWalls extends CApplications
{

	public function onProfileDisplay()
	{
		$user = CFactory::getRequestUser();
		JLoader::discover('ccommentHelper', JPATH_ROOT . '/components/com_comment/helpers');
		return ccommentHelperUtils::commentInit('com_community', $user, $user->_cparams);
	}

}
