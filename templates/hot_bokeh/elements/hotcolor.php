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
class JFormFieldHotcolor extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'hotcolor';

	/**
	 * Method to get the field input markup.
	 *
	 * @return	string	The field input markup.
	 * @since	1.6
	 */
	protected function getInput()
	{
	    $this->value = htmlspecialchars(html_entity_decode($this->value, ENT_QUOTES), ENT_QUOTES);
	    $OUT= '';
	    ob_start();
		
		if(stripos($this->value,'#') < 0 && stripos($this->value,'transparent') < 0){
		  $this->value = "#".$this->value;
		}
		
		?>
			<input type="text" name="<?php echo $this->name; ?>" id="<?php echo $this->id; ?>" style="background-color:<?php echo $this->value ?>;" class="pckcolor" value="<?php echo $this->value; ?>" />
		<?php
		$OUT = ob_get_contents();
        ob_end_clean();		
        return $OUT;
		
		
		
		
		
	
	}
}
