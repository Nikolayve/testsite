<?php
/**
 * @package - com_comment
 * @author: DanielDimitrov - compojoom.com
 * @date: 29.03.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');


class plgAdsmanagercontentCComment extends JPlugin
{

	/**
	 *
	 * @param $content
	 *
	 * @return bool|mixed|string|void
	 *
	 */
	public function ADSonContentAfterDisplay($content)
	{
		JLoader::discover('ccommentHelper', JPATH_SITE . '/components/com_comment/helpers');
		return ccommentHelperUtils::commentInit('com_adsmanager', $content);
	}

}