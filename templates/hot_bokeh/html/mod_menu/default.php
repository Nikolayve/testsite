<?php
/**
 * @version		$Id: default.php 22355 2011-11-07 05:11:58Z github_bot $
 * @package		Joomla.Site
 * @subpackage	mod_menu
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

// Note. It is important to remove spaces between elements.


global $mnucfg;
$sparky_mnu = '';
 
if(isset($mnucfg)){
  $sparky_mnu = $mnucfg[$params->get('menutype')]['type'];
  if( $sparky_mnu == "navv" ||  $sparky_mnu == "navh" ||  $sparky_mnu == "acc" ){
	$params->set('startLevel',1);
	$params->set('endLevel',0);
	$params->set('showAllChildren',1);
	$list	= modMenuHelper::getList($params);
  }
}

?>

<ul class="menu<?php echo $class_sfx;?> <?php if ($sparky_mnu!="none") { echo $sparky_mnu;echo ' mnu_'.$params->get('menutype'); } ?>"<?php
    $tag = '';
	if ($params->get('tag_id')!=NULL) {
		$tag = $params->get('tag_id').'';
		echo ' id="'.$tag.'"';
	}
?>>
<?php
foreach ($list as $i => &$item) :
	$class = 'item-'.$item->id;
	if ($item->id == $active_id) {
		$class .= ' current';
	}

	if (	$item->type == 'alias' &&
			in_array($item->params->get('aliasoptions'),$path)
		||	in_array($item->id, $path)) {
		$class .= ' active';
	}

	if ($item->deeper) {
		$class .= ' deeper';
	}

	if ($item->parent) {
		$class .= ' parent';
	}

	if (!empty($class)) {
		$class = ' class="'.trim($class) .'"';
	}

	echo '<li'.$class.'>';

	// Render the menu item.
	switch ($item->type) :
		case 'separator':
		case 'url':
		case 'component':
			require JModuleHelper::getLayoutPath('mod_menu', 'default_'.$item->type);
			break;

		default:
			require JModuleHelper::getLayoutPath('mod_menu', 'default_url');
			break;
	endswitch;

	// The next item is deeper.
	if ($item->deeper) {
		echo '<ul>';
	}
	// The next item is shallower.
	elseif ($item->shallower) {
		echo '</li>';
		echo str_repeat('</ul></li>', $item->level_diff);
	}
	// The next item is on the same level.
	else {
		echo '</li>';
	}
endforeach;
?></ul>
