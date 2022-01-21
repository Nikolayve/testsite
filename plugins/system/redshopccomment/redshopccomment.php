<?php
/**
 * @package    - com_comment
 * @author     : DanielDimitrov - compojoom.com
 * @date       : 29.03.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Direct Access to this location is not allowed.');

class plgSystemRedshopccomment extends JPlugin
{

	public function onAfterDisplayProduct(&$productTemplate, $params, $data)
	{
		$input = JFactory::getApplication()->input;
		// make sure that we are executing the plugin within redshop
		if ($input->getCmd('option') == 'com_redshop')
		{
			JLoader::discover('ccommentHelper', JPATH_ROOT . '/components/com_comment/helpers');
			$productTemplate .= ccommentHelperUtils::commentInit('com_redshop', $data, $params);
		}
	}

}
