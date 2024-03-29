<?php
/**
 * @package    Hotspots
 * @author     DanielDimitrov <daniel@compojoom.com>
 * @date       17.09.14
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die;

/**
 * The stats reporting Model
 *
 * @since  4.0
 */
class HotspotsModelStats extends CompojoomModelStats
{
	protected $extension = 'com_hotspots';

	protected $exclude = array(
		'downloadid',
		'welcome_text',
		'api_key',
		'recaptcha_public_key',
		'recaptcha_private_key'
	);

	/**
	 * Here we set a custom extension name
	 *
	 * @return array
	 */
	public function getCustomExtensionData()
	{
		$data['extension'] = $this->extension . '.' . (HOTSPOTS_PRO ? 'pro' : 'core');

		return $data;
	}
}
