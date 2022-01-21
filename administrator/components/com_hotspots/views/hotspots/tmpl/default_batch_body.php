<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;
$published = $this->state->get('filter.published');
?>

<div class="row">
	<div class="col-sm-6">
		<div class="controls">
			<?php echo JHtml::_('batch.language'); ?>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="controls">
			<?php echo JHtml::_('batch.access'); ?>
		</div>
	</div>
</div>
<div class="row">
	<?php if ($published >= 0) : ?>
		<div class="col-sm-6">
			<div class="controls">
				<?php echo JHtml::_('batch.item', 'com_hotspots'); ?>
			</div>
		</div>
	<?php endif; ?>
</div>
