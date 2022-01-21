<?php
/**
 * @package    Hotspots
 * @author     DanielDimitrov <daniel@compojoom.com>
 * @date       02.07.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Class HotspotsHelperLocation
 *
 * @since  3.5
 */
class HotspotsHelperLocation
{
	/**
	 * Gets the user's location on the base of his IP address.
	 * The location is determined by the free geo IP service and the
	 * requests are cached to save bandwith
	 *
	 * @return mixed
	 */
	public static function getUserLocation()
	{
		$ip = self::getUserIp();

		$cache = JFactory::getCache('com_hotspots_geoip', 'output');
		$cache->setCaching(true);

		$location = $cache->get($ip);

		if (!$location && $location !== 404)
		{
			$location = self::getLocation($ip);

			// If we don't have an object with the location write 404 for this IP
			if (!$location)
			{
				$location = 404;
			}

			$cache->store($location, $ip);
		}

		// We don't have a location, so return false
		if ($location === 404)
		{
			return false;
		}

		return json_decode($location);
	}

	/**
	 * Get's the user location by querying the freegeoip service
	 *
	 * @param   string  $ip  - the IP that we need a location object for
	 *
	 * @return bool|string
	 */
	private static function getLocation($ip)
	{
		$url = 'http://freegeoip.net/json/' . $ip;

		$options = new JRegistry;
		$transport = new JHttpTransportCurl($options);

		// Create a 'curl' transport.
		$http = new JHttp($options, $transport);

		try
		{
			$get = $http->get($url);
		}
		catch (Exception $e)
		{
			return false;
		}


		if ($get->code === 200)
		{
			return $get->body;
		}

		return false;
	}

	/**
	 * Makes a best quess what the user's IP is
	 *
	 * @return mixed
	 */
	private static function getUserIp()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP']))
		{
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
			$ip = $_SERVER['REMOTE_ADDR'];
		}

		return $ip;
	}
}
