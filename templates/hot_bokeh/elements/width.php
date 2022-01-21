<?php
/*------------------------------------------------------------------------
# "Sparky Framework" - Joomla Template Framework
# Copyright (C) 2013 HotThemes. All Rights Reserved.
# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
# Author: HotThemes
# Website: http://www.hotjoomlatemplates.com
-------------------------------------------------------------------------*/

defined('JPATH_BASE') or die;

jimport('joomla.form.formfield');

/**
 * Form Field class for the Joomla Framework.
 *
 * @package		Joomla.Framework
 * @subpackage	Form
 * @since		1.6
 */
class JFormFieldWidth extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'width';

	/**
	 * Method to get the field input markup.
	 *
	 * @return	string	The field input markup.
	 * @since	1.6
	 */
	protected function getInput()
	{
	    global $TEMPLATE_FOLDER;
        $document = JFactory::getDocument();
		$btnimgurl = JURI::root(1) . '/templates/'.$TEMPLATE_FOLDER.'/images/ipbutton.png';		
		
		$this->value = htmlspecialchars(html_entity_decode($this->value, ENT_QUOTES), ENT_QUOTES);
	    $OUT= 
		'<div class="width_value" >
		<input type="hidden" name="'.$this->name.'" id="'.$this->id.'" value="'.$this->value.'" />
        
		<table>
		<tr>
		<td>
		<span id="disp'.$this->id.'" style="float:left;width:50px;">'.$this->value.'px</span>
		</td>
		<td>
		<div class="width" id="width'.$this->id.'"  > 
		
		</div>
		</td>
		</tr>
		</table>
		</div>';
		return $OUT;
	}
}

?>