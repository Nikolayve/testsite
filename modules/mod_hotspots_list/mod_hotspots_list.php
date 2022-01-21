<?php
/**
 * @package    Hotspots
 * @author     DanielDimitrov <daniel@compojoom.com>
 * @date       10.07.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

// Include the syndicate functions only once
require_once __DIR__ . '/helper.php';

$list = ModHotspotsHelper::getList($params);

require JModuleHelper::getLayoutPath('mod_hotspots_list', $params->get('layout', 'default'));
