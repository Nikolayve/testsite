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
 


class JFormFieldSubtabstart extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'subtabstart';

	/**
	 * Method to get the field input markup.
	 *
	 * @return	string	The field input markup.
	 * @since	1.6
	 */
	protected function getInput()
	{
		$OUT= '';
		ob_start();
		?>
		  <h3 class="subtabstart" title="<?php echo $this->description;?>"  >
			 <?php echo $this->label;?>
		  </h3>
		<?php
		$OUT .= ob_get_contents();
		ob_end_clean();		
        return $OUT;
	}
}
