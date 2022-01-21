<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  Copyright 2011 Daniel Dimitrov. (http://compojoom.com)
 *  All rights reserved
 *
 *  This script is part of the Hotspots project. The Hotspots project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *  A copy is found in the textfile GPL.txt and important notices to the license
 *  from the author is found in LICENSE.txt distributed with these scripts.
 *
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.controllerform');

class HotspotsControllerForm extends JControllerForm
{
	public $context = 'hotspot';

	public $view_item = 'form';
	public $view_list = 'hotspots';

	public function edit($key = null, $urlVar = 'id')
	{
		$result = parent::edit($key, $urlVar);

		return $result;
	}

	/**
	 * Check if the user has the sufficient user rights to edit the hotspot
	 *
	 * @param    array  $data    An array of input data.
	 * @param    string $key     The name of the key for the primary key.
	 *
	 * @return    boolean
	 * @since    1.6
	 */
	protected function allowEdit($data = array(), $key = 'id')
	{
		// Initialise variables.
		$recordId = (int) isset($data[$key]) ? $data[$key] : 0;

		$user = JFactory::getUser();
		$userId = $user->get('id');
		$asset = 'com_hotspots.marker.' . $recordId;

		// Check general edit permission first.
		if ($user->authorise('core.edit', $asset))
		{
			return true;
		}

		// Fallback on edit.own.
		// First test if the permission is available.
		if ($user->authorise('core.edit.own', $asset))
		{
			// Now test the owner is the user.
			$ownerId = (int) isset($data['created_by']) ? $data['created_by'] : 0;

			if (empty($ownerId) && $recordId)
			{
				// Need to do a lookup from the model.
				$record = $this->getModel()->getItem($recordId);

				if (empty($record))
				{
					return false;
				}

				$ownerId = $record->created_by;
			}

			// If the owner matches 'me' then do the test.
			if ($ownerId == $userId)
			{
				return true;
			}
		}

		// Since there is no asset tracking, revert to the component permissions.
		return parent::allowEdit($data, $key);
	}

	/**
	 * If redirecting back to the hotspots view -> set the layout
	 * @return string
	 */
	protected function getRedirectToListAppend()
	{
		$append = '&layout=userhotspots';

		return $append;
	}
}
