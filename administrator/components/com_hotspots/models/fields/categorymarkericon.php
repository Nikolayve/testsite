<?php
/**
 * @package    Hotspots
 * @author     DanielDimitrov <daniel@compojoom.com>
 * @date       04.07.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

JFormHelper::loadFieldClass('list');

/**
 * JFormFieldCategorymarkerimage
 *
 * @since  3.0
 */
class JFormFieldCategorymarkericon extends JFormField
{
	/**
	 * A flexible category list that respects access controls
	 *
	 * @var        string
	 * @since    1.6
	 */
	public $type = 'categorymarkericon';

	/**
	 * Constructor
	 *
	 * @param   JForm  $form  - the form
	 */
	public function __construct($form = null)
	{
		parent::__construct($form);

		JHTML::_('behavior.framework', true);

		// Add some css
		$document = JFactory::getDocument();
		$css = JURI::root() . '/media/com_hotspots/css/fields/markerImage.css';
		JHTML::_('stylesheet', 'media/com_hotspots/css/hotspots-backend.css');
		$document->addStyleSheet($css);
	}

	/**
	 * Creates the output
	 *
	 * @return string
	 */
	protected function getInput()
	{
		jimport('joomla.filesystem.folder');

		// Add some javascript to the head
		$document = JFactory::getDocument();
		JHTML::_('script', 'media/com_hotspots/js/fixes.js');

		JHTML::_('script', 'media/com_hotspots/js/lazy/LazyLoad.js', '');
		JHTML::_('script', 'media/com_hotspots/js/modules/backend/category.js');

		// Keep mootools on older installations
		if (JVERSION < 3)
		{
			$domready =	"window.addEvent('domready', function() {";
		}

		// Do the jquery shit...
		if (JVERSION > 3)
		{
			JHtml::_('jquery.framework');
			$domready =	"jQuery(document).ready(function() {";
			$domready .= "jQuery('#select-icon').chosen('destroy');";
		}

		$domready .= "
			var hotspotCategory = new compojoom.hotspots.modules.categories();
		});";

		$document->addScriptDeclaration($domready);

		//        some output
		$html = array();
		$path = JPATH_ROOT . '/media/com_hotspots/images/categories/sample';
		$exclude = array('.svn', 'CVS', '.DS_Store', '__MACOSX', 'index.html', 'blank.gif');
		$sampleIcons = JFolder::files($path, '.', false, false, $exclude);

		$selected = 0;
		$image = '';

		if ($this->value)
		{
			$selected = 1;
			$image = JURI::root() . $this->value;
		}

		$options = array(
			JHTML::_('select.option', '', JText::_('COM_HOTSPOTS_SELECT')),
			JHTML::_('select.option', 'new', JText::_('COM_HOTSPOTS_UPLOAD_NEW_IMAGE')),
			JHTML::_('select.option', 'sample', JText::_('COM_HOTSPOTS_SELECT_SAMPLE_IMAGE'))
		);

		$html[] = '<div id="category-icon">';

		if ($image)
		{
			$html[] = '<img src="' . $image . '" />';
		}

		$html[] = '</div>';

		$html[] = JHTML::_('select.genericlist', $options, 'select-icon', null, 'value', 'text', $selected);

		$html[] = '<div class="clr"></div>';
		$html[] = '<div id="select-sample-image" style="display: none">';

		foreach ($sampleIcons as $icon)
		{
			$title = explode('.', $icon);

			$path = JURI::root() . 'media/com_hotspots/images/categories/sample/' . $icon;
			$html[] = '<div>';
			$html[] = '<img src="' . JURI::root() . 'media/com_hotspots/images/categories/sample/blank.gif"
             data-src="' . $path . '" title="' . $title[0] . '"/>';
			$html[] = '<span data-id="' . $icon . '"> ' . $title[0] . '</span>';
			$html[] = '</div>';
		}

		$html[] = '</div>';
		$html[] = '<input type="hidden" id="' . $this->id . '" name="' . $this->name . '" value="' . $this->value . '" />';

		return implode("\n", $html);
	}
}
