<?php
/*------------------------------------------------------------------------
# "Hot Full Carousel" Joomla module
# Copyright (C) 2013 HotJoomlaTemplates.com. All Rights Reserved.
# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
# Author: HotJoomlaTemplates.com
# Website: http://www.hotjoomlatemplates.com
-------------------------------------------------------------------------*/

defined('_JEXEC') or die('Restricted access'); // no direct access

jimport('joomla.form.formfield');

/**
 * Form Field class for the Joomla Framework.
 *
 * @package		Joomla.Framework
 * @subpackage	Form
 * @since		1.6
 */
class JFormFieldLoader extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'Loader';

	/**
	 * Method to get the field input markup.
	 *
	 * @return	string	The field input markup.
	 * @since	1.6
	 */
	function getInput(){
		$document = JFactory::getDocument();
		$header_media = $document->addScript(JURI::root(1) . '/modules/mod_hot_full_carousel/js/jscolor.js');
	}
}