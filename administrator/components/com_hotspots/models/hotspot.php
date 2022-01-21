<?php

/**
 * @author     Daniel Dimitrov <daniel@compojoom.com>
 * @date:      06.08.2013
 *
 * @copyright  Copyright (C) 2008 - 2012 compojoom.com . All rights reserved.
 * @license	    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die();
jimport('joomla.application.component.modeladmin');

/**
 * Class HotspotsModelHotspot
 *
 * @since  3.0
 */
class HotspotsModelHotspot extends JModelAdmin
{
	/**
	 * @var        string    The prefix to use with controller messages.
	 * @since    1.6
	 */
	protected $text_prefix = 'COM_HOTSPOTS';

	/**
	 * Prepare and sanitise the table data prior to saving.
	 *
	 * @param   JTable  $table  - A JTable object.
	 *
	 * @return    void
	 *
	 * @since    1.6
	 */
	protected function prepareTable($table)
	{
		// Set the publish date to now
		if ($table->state == 1 && intval($table->publish_up) == 0)
		{
			$table->publish_up = JFactory::getDate()->toSql();
		}

	}

	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param   string  $type    The table type to instantiate
	 * @param   string  $prefix  A prefix for the table class name. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return JTable    A database object
	 */
	public function getTable($type = 'Marker', $prefix = 'Table', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * Method to get the record form.
	 *
	 * @param   array    $data      An optional array of data for the form to interogate.
	 * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
	 *
	 * @return    JForm    A JForm object on success, false on failure
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Initialise variables.
		$app = JFactory::getApplication();

		// Get the form.
		$form = $this->loadForm('com_hotspots.marker', 'marker', array('control' => 'jform', 'load_data' => $loadData));

		// Make sure that the custom fields are part of the form
		JLoader::discover('HotspotsModel', JPATH_COMPONENT_SITE . '/models');
		$customFieldsModel = $this->getInstance('Customfields', 'HotspotsModel');
		$form->load(
			CompojoomFormCustom::generateFormXML(
				$customFieldsModel->getFields('com_hotspots.hotspot', isset($data['catid']) ? $data['catid'] : 0),
				'com_hotspots'
			)
		);

		if (empty($form))
		{
			return false;
		}

		// Determine correct permissions to check.
		if ($this->getState('hotspot.id'))
		{
			// Existing record. Can only edit in selected categories.
			$form->setFieldAttribute('catid', 'action', 'core.edit');
		}
		else
		{
			// New record. Can only create in selected categories.
			$form->setFieldAttribute('catid', 'action', 'core.create');
		}

		// Modify the form based on access controls.
		if (!$this->canEditState((object) $data))
		{
			// Disable fields for display.
			$form->setFieldAttribute('state', 'disabled', 'true');
			$form->setFieldAttribute('publish_up', 'disabled', 'true');
			$form->setFieldAttribute('publish_down', 'disabled', 'true');

			// Disable fields while saving.
			// The controller has already verified this is a record you can edit.
			$form->setFieldAttribute('state', 'filter', 'unset');
			$form->setFieldAttribute('publish_up', 'filter', 'unset');
			$form->setFieldAttribute('publish_down', 'filter', 'unset');
		}

		return $form;
	}

	/**
	 * Method to get a single record.
	 *
	 * @param   integer  $pk -  The id of the primary key.
	 *
	 * @return  mixed    Object on success, false on failure.
	 */
	public function getItem($pk = null)
	{
		if ($item = parent::getItem($pk))
		{
			$item->hotspotText = trim($item->description) != '' ?
				$item->description_small . "<hr id=\"system-readmore\" />" . $item->description : $item->description_small;
		}

		return $item;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return    mixed    The data for the form
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_hotspots.edit.hotspot.data', array());

		if (empty($data))
		{
			$data = $this->getItem();
		}

		return $data;
	}
}
