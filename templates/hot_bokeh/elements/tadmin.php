<?php
/*------------------------------------------------------------------------
# "Sparky Framework" - Joomla Template Framework
# Copyright (C) 2013 HotThemes. All Rights Reserved.
# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
# Author: HotThemes
# Website: http://www.hotjoomlatemplates.com
-------------------------------------------------------------------------*/

defined('JPATH_BASE') or die;
if(!defined('DS')) {
    define("DS", DIRECTORY_SEPARATOR);
}
jimport('joomla.form.formfield');

/**
 * Form Field class for the Joomla Framework.
 *
 * @package		Joomla.Framework
 * @subpackage	Form
 * @since		1.6
 */
 


class JFormFieldTadmin extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'tadmin';

	/**
	 * Method to get the field input markup.
	 *
	 * @return	string	The field input markup.
	 * @since	1.6
	 */
	protected function getInput()
	{
	
	    global $TEMPLATE_FOLDER;
	    $TEMPLATE_FOLDER = basename(realpath( dirname(__FILE__) . DIRECTORY_SEPARATOR . '..'));
	
 	    $document = JFactory::getDocument();
		$document->addStyleSheet(JURI::root(1) . '/templates/'.$TEMPLATE_FOLDER.'/css/tadmin.css');
		$document->addStyleSheet(JURI::root(1) . '/templates/'.$TEMPLATE_FOLDER.'/js/colorpicker/css/colorpicker.css');
		if (preg_match("/2.5/i", JVERSION)) { $document->addScript('//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js'); }
		$document->addScript('//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js');
		$document->addScript(JURI::root(1) . '/templates/'.$TEMPLATE_FOLDER.'/js/colorpicker/js/colorpicker.js');
	    $document->addScript(JURI::root(1) . '/templates/'.$TEMPLATE_FOLDER.'/js/tadmin.js');
		
		$lang = JFactory::getLanguage();
		$lpreff= $lang->getTag();
		
	    $help_dir =  '..'.DS.'templates'.DS.$TEMPLATE_FOLDER.DS.'help'.DS.$lpreff.DS;
		$help_files = glob($help_dir.'{*.html,*.htm}',GLOB_BRACE);
		
		if(!count($help_files)){
		 $lpreff = 'en-GB';
		 $help_dir =  '..'.DS.'templates'.DS.$TEMPLATE_FOLDER.DS.'help'.DS.$lpreff.DS;
		 $help_files = glob($help_dir.'{*.html,*.htm}',GLOB_BRACE);
		}
		
		$OUT= '';
		ob_start();
		for( $loop = 0 ; $loop < count($help_files); $loop ++) {
		
		   $hlpName = basename(basename($help_files[$loop],'.htm'),'.html');
		   $fh = fopen($help_files[$loop], 'r');
           $hlpContent = fread($fh, filesize($help_files[$loop]));
           fclose($fh);
		?>
		 	  <div id="<?php echo $hlpName;?>" class="tadmin_help" style="display:none;" >
			     <?php echo $hlpContent;?>
			  </div>
		<?php
					
		}
		
		?>
		  <script type="text/javascript" >
		   $ = jQuery;
		   var TADMSCRIPTTRANS = {};
		   TADMSCRIPTTRANS.general    = '<?php echo jText::sprintf('TPL_SPARKY_FRAMEWORK_GENERAL')?>';
		   var TADMIN_JOOMLABASE      = '<?php echo JURI::root(1); ?>';
		   var TADMIN_TEMPLATE_FOLDER = '<?php echo $TEMPLATE_FOLDER; ?>';
		   var TADMIN_LANG = {
				details: '<?php echo JText::sprintf("TPL_SPARKY_FRAMEWORK_DETAILS"); ?>',
				menusassignment: '<?php echo JText::sprintf("TPL_SPARKY_FRAMEWORK_ASIGNMENT"); ?>'
		   };
		  </script>
		<?php
		
		$OUT .= ob_get_contents();
		ob_end_clean();
		
		$doc = new DOMDocument(); 
        $doc->load('..'.DS.'templates'.DS.$TEMPLATE_FOLDER.DS.'templateDetails.xml');
		
		//extension/positions/position 
		
		
		$XPostions = $doc->getElementsByTagName( "extension" )->item(0);
		$XPostions = $XPostions->getElementsByTagName( "positions" )->item(0);
		$XPostions = $XPostions->getElementsByTagName( "position" );
		global $tadmin_mpos; 
		$tadmin_mpos = array();
		 $loop = 0;
		
		foreach( $XPostions as $XPostion ) 
		{
		  $tadmin_mpos[$loop] = $XPostion->nodeValue;
          $loop++; 
		}
	   
        return $OUT;
		
	}
}
