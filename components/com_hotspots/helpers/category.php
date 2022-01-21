<?php
/**
 * @package    com_hotspots
 * @author     DanielDimitrov <daniel@compojoom.com>
 * @date       18.01.2015
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

class HotspotsCategories extends JCategories
{
	/**
	 * Constructor
	 *
	 * @param   array  $options  Array of options
	 *
	 * @since   1.6
	 */
	public function __construct($options = array())
	{
		$options['table']     = '#__hotspots_marker';
		$options['extension'] = 'com_hotspots';

		parent::__construct($options);
	}
}
