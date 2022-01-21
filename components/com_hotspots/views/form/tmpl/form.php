<?php
/**
 * @author     Daniel Dimitrov
 * @date       : 19.04.2013
 *
 * @copyright  Copyright (C) 2008 - 2012 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

$doc = JFactory::getDocument();
$doc->addScript(HotspotsHelperUtils::getGmapsUrl());

if (HotspotsHelperSettings::get('emulate_bootstrap', 1))
{
	JHTML::_('stylesheet', 'media/lib_compojoom/css/bootstrap-3.1.1.css');
}

JHTML::stylesheet('media/lib_compojoom/third/font-awesome/css/font-awesome.min.css');

JHTML::_('stylesheet', 'media/com_hotspots/css/form.css');
//JHTML::_('stylesheet', 'media/com_hotspots/css/hotspots.css');

JHTML::_('behavior.framework', true);
JHTML::_('behavior.tooltip');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
JHTML::_('behavior.calendar');

$this->setMootoolsLocale();
JHTML::_('script', 'media/com_hotspots/js/fixes.js');
JHTML::_('script', 'media/com_hotspots/js/moo/Class.SubObjectMapping.js');
JHTML::_('script', 'media/com_hotspots/js/moo/Map.js');
JHTML::_('script', 'media/com_hotspots/js/moo/Map.Extras.js');
JHTML::_('script', 'media/com_hotspots/js/moo/Map.Marker.js');
JHTML::_('script', 'media/com_hotspots/js/moo/Map.InfoWindow.js');
JHTML::_('script', 'media/com_hotspots/js/moo/Map.Geocoder.js');

JHTML::_('script', 'media/com_hotspots/js/helpers/helper.js');

JHTML::_('script', 'media/com_hotspots/js/core.js');
JHTML::_('script', 'media/com_hotspots/js/sandbox.js');
JHTML::_('script', 'media/com_hotspots/js/modules/submit.js');

HotspotsHelperUtils::getJsLocalization();
$options = HotspotsHelperUtils::getJSVariables();
$domready = <<<ABC
window.addEvent('domready', function() {
	var hotspots = new compojoom.hotspots.core();

	{$options}
	hotspots.DefaultOptions.centerType = 0;
	hotspots.addSandbox('map-add', hotspots.DefaultOptions);
	hotspots.addModule('submit',hotspots.DefaultOptions);
	hotspots.startAll();
});
ABC;

$doc = JFactory::getDocument();
$doc->addScriptDeclaration($domready);
?>
<script type="text/javascript">
	Joomla.submitbutton = function (task) {
		if (document.formvalidator.isValid(document.id('adminForm'))) {
			<?php echo $this->form->getField('hotspotText')->save(); ?>
			Joomla.submitform(task);
			// Disable the button so that we don't end up with multiple sent forms
			document.id('adminForm').getElement('button[type=submit]').set('disabled', 'disabled');
		} else {
			return false;
		}
	}
</script>
<div id="hotspots" class="compojoom-bootstrap hotspots addform">
	<form action="<?php echo JRoute::_('index.php?option=com_hotspots&view=form&id=' . (int) $this->item->id); ?>"
	      method="post" class="form form-validate form-horizontal hs-frontend-form" name="adminForm" id="adminForm" enctype="multipart/form-data">
		<div class="row">
			<div class="col-sm-12">
				<h2>
					<?php echo empty($this->item->id) ?
						JText::_('COM_HOTSPOTS_NEW_HOTSPOT') :
						JText::sprintf('COM_HOTSPOTS_EDIT_HOTSPOT', $this->item->id); ?>
				</h2>

				<?php if (!$this->user->id) : ?>
					<div class="form-group">
						<?php echo $this->form->getLabel('created_by_alias'); ?>
						<div class="col-sm-10">
							<?php echo $this->form->getInput('created_by_alias'); ?>
						</div>
					</div>
					<div class="form-group">
						<?php echo $this->form->getLabel('email'); ?>
						<div class="col-sm-10">
							<?php echo $this->form->getInput('email'); ?>
						</div>
					</div>
				<?php endif; ?>

				<div class="form-group">
					<?php echo $this->form->getLabel('title'); ?>
					<div class="col-sm-10">
						<?php echo $this->form->getInput('title'); ?>
					</div>
				</div>

				<div class="form-group">
					<?php echo $this->form->getLabel('catid'); ?>
					<div class="col-sm-10">
						<?php echo $this->form->getInput('catid'); ?>
					</div>
				</div>

				<div class="form-group">
					<?php echo $this->form->getLabel('picture'); ?>
					<div class="col-sm-10">
						<?php echo $this->form->getInput('picture'); ?>
					</div>
				</div>

				<div class="form-group">
					<?php echo $this->form->getLabel('hotspotText'); ?>
					<div class="col-sm-10">
						<?php echo $this->form->getInput('hotspotText'); ?>
					</div>
				</div>

				<div class="clearfix"></div>
				<div id="custom-fields"></div>

				<fieldset class="adminform">

					<h2><?php echo JText::_('COM_HOTSPOTS_LOCATION_DETAILS'); ?></h2>

					<div id="hotspots-geolocation-info"></div>

					<div class="clearfix"></div>

					<div class="form-group">
						<?php echo $this->form->getLabel('street'); ?>
						<div class="col-sm-10">
							<div class="input-group">
								<?php echo $this->form->getInput('street'); ?>
								<span class="input-group-btn">
						            <button type="button" id="hotspots-geolocation" class="btn btn-default">
							            <span class="fa fa-street-view"></span>
							            <?php echo JText::_('COM_HOTSPOTS_FIND_MY_LOCATION'); ?>
						            </button>
								</span>
							</div>
						</div>
					</div>
					<?php if (HotspotsHelperSettings::get('user_interface', 1) == 0) : ?>
						<div class="form-group">
							<?php echo $this->form->getLabel('plz'); ?>
							<div class="col-sm-10">
								<?php echo $this->form->getInput('plz'); ?>
							</div>
						</div>

						<div class="form-group">
							<?php echo $this->form->getLabel('town'); ?>
							<div class="col-sm-10">
								<?php echo $this->form->getInput('town'); ?>
							</div>
						</div>
					<?php else: ?>
						<div class="form-group">
							<?php echo $this->form->getLabel('town'); ?>
							<div class="col-sm-10">
								<?php echo $this->form->getInput('town'); ?>
							</div>
						</div>
						<div class="form-group">
							<?php echo $this->form->getLabel('plz'); ?>
							<div class="col-sm-10">
								<?php echo $this->form->getInput('plz'); ?>
							</div>
						</div>

						<div class="form-group">
							<?php echo $this->form->getLabel('administrative_area_level_1'); ?>
							<div class="col-sm-10">
								<?php echo $this->form->getInput('administrative_area_level_1'); ?>
							</div>
						</div>
					<?php endif; ?>

					<div class="form-group">
						<?php echo $this->form->getLabel('country'); ?>
						<div class="col-sm-10">
							<?php echo $this->form->getInput('country'); ?>
						</div>
					</div>
					<div class="form-group">
						<?php echo $this->form->getLabel('sticky', 'params'); ?>
						<div class="col-sm-10">
							<?php echo $this->form->getInput('sticky', 'params'); ?>
						</div>
					</div>

					<div id="map-add"
					     title="<?php echo JText::_('COM_HOTSPOTS_MOVE_MARKER_DRAG'); ?>"></div>

					<div class="form-group">
						<div class="col-sm-6">
							<?php echo $this->form->getLabel('gmlat'); ?>
							<?php echo $this->form->getInput('gmlat'); ?>
						</div>
						<div class="col-sm-6">
							<?php echo $this->form->getLabel('gmlng'); ?>
							<?php echo $this->form->getInput('gmlng'); ?>
						</div>
					</div>
				</fieldset>

				<?php if ($this->user->authorise('core.edit.state', 'com_hotspots')) : ?>
					<fieldset class="adminform">
						<h2><?php echo JText::_('COM_HOTSPOTS_FIELDSET_PUBLISHING'); ?></h2>

						<div class="form-group">
							<?php echo $this->form->getLabel('publish_up'); ?>
							<div class="col-sm-10 form-inline">
								<?php echo $this->form->getInput('publish_up'); ?>
							</div>
						</div>
						<div class="clearfix"></div>

						<div class="form-group">
							<?php echo $this->form->getLabel('publish_down'); ?>
							<div class="col-sm-10 form-inline">
								<?php echo $this->form->getInput('publish_down'); ?>
							</div>
						</div>
						<div class="clearfix"></div>

						<div class="form-group">
							<?php echo $this->form->getLabel('state'); ?>
							<div class="col-sm-10">
								<?php echo $this->form->getInput('state'); ?>
							</div>
						</div>

						<div class="form-group">
							<?php echo $this->form->getLabel('access'); ?>
							<div class="col-sm-10">
								<?php echo $this->form->getInput('access'); ?>
							</div>
						</div>

						<div class="form-group">
							<?php echo $this->form->getLabel('language'); ?>
							<div class="col-sm-10">
								<?php echo $this->form->getInput('language'); ?>
							</div>
						</div>
					</fieldset>

				<?php endif; ?>

				<?php if (!JFactory::getApplication()->input->getInt('id')) : ?>
					<?php if ($this->showCaptcha): ?>
						<fieldset class="security">
							<h2><?php echo JText::_('COM_HOTSPOTS_SECURITY'); ?></h2>

							<div class="form-group">
								<label for="recaptcha_response_field" class="col-sm-2 compojoom-control-label">
									<?php echo JText::_('COM_HOTSPOTS_CAPTCHA'); ?>
								</label>

								<div class="col-sm-10">
									<div id="dynamic_recaptcha_1"></div>
								</div>
							</div>
						</fieldset>
					<?php endif; ?>
				<?php endif; ?>

				<button type="submit" class="btn btn-primary pull-right"
				        onclick="Joomla.submitbutton('hotspot.save'); return false;">
					<?php echo JText::_('COM_HOTSPOTS_SUBMIT'); ?>
				</button>
			</div>
		</div>
		<div class="clearfix"></div>
		<input type="hidden" name="task" value=""/>
		<input type="hidden" id="hotspot-id" name="hotspot-id" value="<?php echo (int) $this->item->id; ?>"/>
		<input type="hidden" name="return" value="<?php echo $this->returnPage; ?>"/>
		<?php echo JHTML::_('form.token'); ?>
	</form>
</div>
