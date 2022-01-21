<?php

/*
 * Copyright Copyright (C) 2009 Daniel Dimitrov - compojoom.com . All rights reserved.
 * License http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * !JoomlaComment is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * !JoomlaComment is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA  02110-1301, USA.
 */

defined('_JEXEC') or die('Direct Access to this location is not allowed.');

class plgContentCompojoomcommentjevents extends JPlugin {

	public function onAfterDisplayContent($row, $params) {
		$mainframe = JFactory::getApplication();
		if ($mainframe->scope == 'com_jevents') {
			JLoader::discover('ccommentHelper', JPATH_ROOT . '/components/com_comment/helpers');
			return ccommentHelperUtils::commentInit('com_jevents', $row, $params);
		}
	}
}