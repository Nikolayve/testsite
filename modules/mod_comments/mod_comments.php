<?php
/**
 * @package    CComment
 * @author     DanielDimitrov <daniel@compojoom.com>
 * @date       22.03.14
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */


defined('_JEXEC') or die('Restricted access');

if (!file_exists(JPATH_SITE . '/administrator/components/com_comment/comment.php'))
{
	echo '<div class="alert alert-error">' . JText::_('MOD_COMMENTS_INSTALL_CCOMMENT_FIRST') . '</div>';

	return false;
}

JLoader::discover('ccomment', JPATH_ROOT . '/administrator/components/com_comment/library');
JLoader::discover('ccommentHelper', JPATH_ROOT . '/components/com_comment/helpers');

CcommentHelperUtils::loadLanguage();

require_once(dirname(__FILE__) . '/helper.php');


$comments = modCommentsHelper::prepareComments(modCommentsHelper::getComments($params), $params);

require JModuleHelper::getLayoutPath('mod_comments', $params->get('template'));
