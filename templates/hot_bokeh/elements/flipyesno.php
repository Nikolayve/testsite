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
class JFormFieldFlipyesno extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'flipyesno';

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
	    $OUT= '';
	    ob_start();
		?>
		<input type="hidden" name="<?php echo $this->name; ?>" id="<?php echo $this->id; ?>" value="<?php echo $this->value; ?>" class="flipyesno" />
		<?php
		$OUT = ob_get_contents();
        ob_end_clean();		
        return $OUT;
	}
}

?>