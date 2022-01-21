<?php
/**
 * @package - com_comment
 * @author: DanielDimitrov - compojoom.com
 * @date: 26.04.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

class plgJoomgalleryCComment extends JPlugin
{

	/**
	 * Displays the number of comments of a specific image
	 *
	 * Method is called by the view
	 *
	 * @param   int     $id The image ID
	 * @return  string  The HTML output for displaying the number of comments
	 * @since   1.5
	 */
	public function onJoomAfterDisplayThumb($id)
	{
		JLoader::discover('ccommentHelper', JPATH_ROOT . '/components/com_comment/helpers');
		// this is a small hack, but over here we don't need any other image object information
		// and since joomgallery is not providing it... let's fake it...
		$image = new stdClass();
		$image->id = $id;
		return ccommentHelperUtils::commentInit('com_joomgallery', $image);

	}

	/**
	 * Displays the comment form
	 * @param $image
	 *
	 * @return bool|mixed|string|void
	 */
	public function onJoomAfterDisplayDetailImage($image) {
		JLoader::discover('ccommentHelper', JPATH_ROOT . '/components/com_comment/helpers');
		return ccommentHelperUtils::commentInit('com_joomgallery', $image);
	}

}