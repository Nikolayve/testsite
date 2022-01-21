<?php
/*
 * Copyright (c) 2010 Daniel Dimitrov (http://compojoom.com) . All rights reserved.
 * License http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * Compojoom Comment is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Compojoom Comment is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA  02110-1301, USA.
 */

defined('_JEXEC') or die('Restricted access');
$document = JFactory::getDocument();
$document->addStyleSheet('media/mod_comments/css/ccomment.css');
if ($params->get('tooltip', 0))
{
JHTML::_('behavior.tooltip');
}
?>
<?php if (!$comments) : ?>
	<span class="small"><i><?php echo JText::_('MOD_COMMENTS_NOCOMMENTS') ?></i></span>
<?php else : ?>
	<?php if ($params->get('orderby') != 'mostcommented') : ?>
		<ul class="ccomment-module">
			<?php foreach ($comments as $comment) : ?>
				<li>
					<div class="ccomment_info">
						<?php if ($params->get('showname', 1)) : ?>
							<?php echo $comment->user . ' ';
							echo JText::_('MOD_COMMENTS_SAID'); ?>
						<?php endif; ?>
						<span class="ccomment_more">
									<?php if ($params->get('tooltip') == 0) : ?>
								<a href="<?php echo $comment->link; ?>">
									<?php echo JText::_('MOD_COMMENTS_MORE'); ?>
								</a>
							<?php else : ?>
								<?php

								$tooltipOverlayBody = $comment->overlayComment;
								if (!$params->get('showconttitle', 1))
								{
									$comment->overlayTitle = '';
								}
								echo JHTML::tooltip($tooltipOverlayBody, $comment->overlayTitle, '', JText::_('MOD_COMMENTS_MORE'), $comment->link);
								?>
							<?php endif; ?>
								</span>
					</div>
					<div class="ccomment_comment">
						<?php echo $comment->comment; ?>
						<?php if (intval($params->get('showtime', 1))) : ?>
							<span class="ccomment_date">
										<?php echo $comment->date; ?>
									</span>
							<div class="ccomment_clear"></div>
						<?php endif; ?>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php else : ?>
		<ul class="ccomment-module">
			<?php foreach ($comments as $comment) : ?>
				<li>
					<a href="<?php echo $comment->link; ?>">
						<?php echo $comment->conttitle ?>
					</a>
					<?php if ($comment->countid) : ?>
						(<?php echo $comment->countid; ?>)
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
<?php endif; ?>