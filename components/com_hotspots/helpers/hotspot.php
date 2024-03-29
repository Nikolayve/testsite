<?php
/**
 * @package    Com_Hotspots
 * @author     DanielDimitrov <daniel@compojoom.com>
 * @date       22.09.2014
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Class HotspotsHelperHotspot
 *
 * @since  4.0
 */
class HotspotsHelperHotspot
{
	/**
	 * Out of the raw $hotspot we create an array with the hotspot data that will be outputed
	 * in json
	 *
	 * @param   object         $hotspot             - the raw hotspot object
	 * @param   array          $users               - an array with user names
	 * @param   array|boolean  $customFieldsConfig  - custom fields config
	 *
	 * @return array
	 */
	public static function prepareHotspotForJsonOutput($hotspot, $users = array(), $customFieldsConfig = false)
	{
		$description = preg_replace("@[\\r|\\n|\\t]+@", '', $hotspot->description_small);
		$address     = self::formattedAddress($hotspot);
		$layout      = new CompojoomLayoutFile('customfields.default');


		$jsonHotspot = array(
			'id'             => (int) $hotspot->hotspots_id,
			'catid'          => (int) $hotspot->catid,
			'lat'            => (float) $hotspot->gmlat,
			'lng'            => (float) $hotspot->gmlng,
			'title'          => $hotspot->title,
			'cutDescription' => CompojoomHtmlString::truncateComplex($description, 100),
			'description'    => $description,
			'street'         => $hotspot->street,
			'city'           => $hotspot->town,
			'zip'            => $hotspot->plz,
			'country'        => $hotspot->country,
			'state'        => $hotspot->administrative_area_level_1,
			'address'        => $address,
			'date'           => $hotspot->created,
			'readmore'       => $hotspot->link,
			'multimedia'     => $hotspot->multimedia,
		);

		// Add the custom fields to the array
		if ($customFieldsConfig)
		{
			$jsonHotspot['customfields'] = preg_replace("@[\\r|\\n|\\t]+@", '', $layout->render(
				array(
					'customfieldsItem'   => (new JRegistry($hotspot->customfields))->toArray(),
					'customfieldsConfig' => $customFieldsConfig
				)
			)
			);
		}

		if (HotspotsHelperSettings::get('show_author', 1))
		{
			// If we haven't passed a users array, let's juse use the created_by

			if (!count($users))
			{
				$usersModel = JModelLegacy::getInstance('Users', 'HotspotsModel');

				if ($hotspot->created_by)
				{
					$users = $usersModel->getUsers(array($hotspot->created_by));
				}
			}

			if ($hotspot->created_by_alias)
			{
				$jsonHotspot['created_by'] = $hotspot->created_by_alias;
			}
			elseif (isset($users[$hotspot->created_by]))
			{
				if (HotspotsHelperSettings::get('use_name', 1))
				{
					$jsonHotspot['created_by'] = $users[$hotspot->created_by]->name;
				}
				else
				{
					$jsonHotspot['created_by'] = $users[$hotspot->created_by]->username;
				}
			}
			else
			{
				$jsonHotspot['created_by'] = 'Anonymous';
			}
		}

		if (isset($users[$hotspot->created_by]) && HotspotsHelperSettings::get('support_avatars', ''))
		{
			$jsonHotspot['avatar'] = $users[$hotspot->created_by]->avatar;
		}

		if (isset($users[$hotspot->created_by]) && HotspotsHelperSettings::get('profile_link', ''))
		{
			$jsonHotspot['profile'] = $users[$hotspot->created_by]->profile;
		}

		if (HotspotsHelperSettings::get('show_date', 1))
		{
			$jsonHotspot['date'] = HotspotsHelperUtils::getLocalDate($hotspot->created);
		}

		if ($hotspot->params->get('markerimage'))
		{
			$jsonHotspot['icon'] = HOTSPOTS_PICTURE_CATEGORIES_PATH . $hotspot->params->get('markerimage');
		}

		return $jsonHotspot;
	}

	/**
	 * Get the custom fields config for the provided categories
	 *
	 * @param   array  $catids  - an array with category ids
	 *
	 * @return bool|array
	 */
	public static function getCustomFieldsConfig($catids = array())
	{
		if (count($catids))
		{
			$customFieldsModel = JModelLegacy::getInstance('Customfields', 'HotspotsModel');
			$customFields      = $customFieldsModel->getFields('com_hotspots.hotspot', $catids);

			// Make a new array that has the slug for key
			foreach ($customFields as $field)
			{
				$customFields[$field->slug] = $field;
			}

			return $customFields;
		}

		return false;
	}

	/**
	 * Create a formatted address for output
	 *
	 * @param   object  $hotspot  - the hotspot that has all the data
	 *
	 * @return string
	 */
	public static function formattedAddress($hotspot)
	{
		$address = array();

		if ($hotspot->street)
		{
			$address[] = trim($hotspot->street);
		}

		if (HotspotsHelperSettings::get('user_interface', 0) == 0)
		{
			if ($hotspot->plz)
			{
				$address[] = $hotspot->plz;
			}

			if ($hotspot->town)
			{
				$address[] = $hotspot->town;
			}
		}
		else
		{
			if ($hotspot->town)
			{
				$address[] = $hotspot->town;
			}

			if ($hotspot->plz)
			{
				$address[] = $hotspot->plz;
			}

			if ($hotspot->administrative_area_level_1)
			{
				$address[] = $hotspot->administrative_area_level_1;
			}
		}

		if ($hotspot->country && HotspotsHelperSettings::get('show_address_country', 0))
		{
			$address[] = $hotspot->country;
		}

		return implode(', ', $address);
	}
}
