<?php
/**
 * @author     Daniel Dimitrov
 * @date: 19.04.2013
 *
 * @copyright  Copyright (C) 2008 - 2012 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

$address = array();

if ($this->hotspot->street)
{
	$address[] = '<span itemprop="streetAddress">' . $this->hotspot->street . '</span>';
}

if (HotspotsHelperSettings::get('user_interface', 1))
{
	if ($this->hotspot->town)
	{
		$address[] = '<span itemprop="addressLocality">' . $this->hotspot->town . '</span>';
	}

	if ($this->hotspot->plz)
	{
		$address[] = '<span itemprop="postalCode">' . $this->hotspot->plz . '</span>';
	}
	if ($this->hotspot->administrative_area_level_1)
	{
		$address[] = '<span itemprop="addressRegion">' . $this->hotspot->administrative_area_level_1 . '</span>';
	}
}
else
{
	$zip = '';
	$town = '';

	if ($this->hotspot->plz)
	{
		$zip = '<span itemprop="postalCode">' . $this->hotspot->plz . '<span>';
	}

	if ($this->hotspot->town)
	{
		$town = '<span itemprop="addressLocality">' . $this->hotspot->town . '</span>';
	}

	if ($zip or $town)
	{
		$address[] = $zip . ' ' . $town;
	}
}

if ($this->settings->get('show_country') && $this->hotspot->country)
{
	$address[] = '<span itemprop="country-name">' . $this->hotspot->country . '</span>';
}
?>
<?php if (HotspotsHelperSettings::get('show_address', 1) && count($address)) : ?>
	<div class="one-line-address text-right">
		<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
			<?php echo implode(',', $address); ?>
		</div>
		<?php if (HotspotsHelperSettings::get('show_coordinates', 0)): ?>
			<div class="hs-coordinates small muted" itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
				<?php echo JText::_('COM_HOTSPOTS_LATITUDE'); ?>:
				<span  itemprop="latitude">
					<?php echo $this->hotspot->gmlat; ?>
				</span>
				|
				<?php echo JText::_('COM_HOTSPOTS_LONGITUDE'); ?>:
				<span  itemprop="latitude">
					<?php echo $this->hotspot->gmlng; ?>
				</span>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>