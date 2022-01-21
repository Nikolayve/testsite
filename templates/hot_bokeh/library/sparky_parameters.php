<?php
/*------------------------------------------------------------------------
# "Sparky Framework" - Joomla Template Framework
# Copyright (C) 2013 HotThemes. All Rights Reserved.
# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
# Author: HotThemes
# Website: http://www.hotjoomlatemplates.com
-------------------------------------------------------------------------*/

$h1Color = $this->params->get("h1Color", "#333333");
$h1Size = $this->params->get("h1Size", "60");
$h1Family = $this->params->get("h1Family", "Arial, Helvetica, sans-serif");
$h1Align = $this->params->get("h1Align", "left");
$h1Weight = $this->params->get("h1Weight", "bold");
$h1Style = $this->params->get("h1Style", "normal");
$h1Underline = $this->params->get("h1Underline", "0");

$h2Color = $this->params->get("h2Color", "#333333");
$h2Size = $this->params->get("h2Size", "32");
$h2Family = $this->params->get("h2Family", "Arial, Helvetica, sans-serif");
$h2Align = $this->params->get("h2Align", "left");
$h2Weight = $this->params->get("h2Weight", "bold");
$h2Style = $this->params->get("h2Style", "normal");
$h2Underline = $this->params->get("h2Underline", "0");

$h3Color = $this->params->get("h3Color", "#333333");
$h3Size = $this->params->get("h3Size", "18");
$h3Family = $this->params->get("h3Family", "Arial, Helvetica, sans-serif");
$h3Align = $this->params->get("h3Align", "left");
$h3Weight = $this->params->get("h3Weight", "bold");
$h3Style = $this->params->get("h3Style", "normal");
$h3Underline = $this->params->get("h3Underline", "0");

$h4Color = $this->params->get("h4Color", "#333333");
$h4Size = $this->params->get("h4Size", "14");
$h4Family = $this->params->get("h4Family", "Arial, Helvetica, sans-serif");
$h4Align = $this->params->get("h4Align", "left");
$h4Weight = $this->params->get("h4Weight", "bold");
$h4Style = $this->params->get("h4Style", "normal");
$h4Underline = $this->params->get("h4Underline", "0");

$pColor = $this->params->get("pColor", "#333333");
$pSize = $this->params->get("pSize", "14");
$pFamily = $this->params->get("pFamily", "Arial, Helvetica, sans-serif");
$pAlign = $this->params->get("pAlign", "left");
$pWeight = $this->params->get("pWeight", "normal");
$pStyle = $this->params->get("pStyle", "normal");

$linksColor = $this->params->get("linksColor", "#8B1E20");
$linksHoverColor = $this->params->get("linksHoverColor", "#333333");
$linksWeight = $this->params->get("linksWeight", "normal");
$linksStyle = $this->params->get("linksStyle", "normal");
$linksUnderline = $this->params->get("linksUnderline", "0");
$linksUnderlineHover = $this->params->get("linksUnderlineHover", "0");

$randomizeCssLink = $this->params->get("randomizeCssLink", "0");

// FEATURES Settings ------------------------------------------------------------

$scrollToTopSwitch = $this->params->get("scrollToTopSwitch", "0");
$scrollToTopImageFile = $this->params->get("scrollToTopImageFile", "top.png");
$scrollToTopPosition = $this->params->get("scrollToTopPosition", "bottom_right");

$equalHeightClasses = $this->params->get("equalHeightClasses", "");

// BODY BACKGROUND Settings -----------------------------------------------------

$bodyBgColor = $this->params->get("bodyBgColor", "#FFFFFF");
$bodyBgImageSwitch = $this->params->get("bodyBgImageSwitch", "0");
$bodyBgImageFile = $this->params->get("bodyBgImageFile", "");
$bodyBgImageVerticalAlign = $this->params->get("bodyBgImageVerticalAlign", "top");
$bodyBgImageHorizontalAlign = $this->params->get("bodyBgImageHorizontalAlign", "center");
$bodyBgImageRepeat = $this->params->get("bodyBgImageRepeat", "repeat");
$bodyBgImageFixedSwitch = $this->params->get("bodyBgImageFixedSwitch", "");
$containerBgColor = $this->params->get("containerBgColor", "transparent");

// LOGO Settings ----------------------------------------------------------------

$logoImageSwitch = $this->params->get("logoImageSwitch", "0");
$logoImageFile = $this->params->get("logoImageFile", "");
$logoImageAlt = $this->params->get("logoImageAlt", "");

$logoText = $this->params->get("logoText", "Sparky");
$logoColor = $this->params->get("logoColor", "#000000");
$logoSize = $this->params->get("logoSize", "40");
$logoFamily = $this->params->get("logoFamily", "Arial, Helvetica, sans-serif");
$logoWeight = $this->params->get("logoWeight", "normal");
$logoStyle = $this->params->get("logoStyle", "normal");
$logoAlign = $this->params->get("logoAlign", "left");

$sloganText = $this->params->get("sloganText", "");
$sloganColor = $this->params->get("sloganColor", "#000000");
$sloganSize = $this->params->get("sloganSize", "14");
$sloganFamily = $this->params->get("sloganFamily", "Arial, Helvetica, sans-serif");
$sloganWeight = $this->params->get("sloganWeight", "normal");
$sloganStyle = $this->params->get("sloganStyle", "normal");
$sloganAlign = $this->params->get("sloganAlign", "left");

// TOP PANEL Settings ----------------------------------------------------------------

$topPanelSwitch = $this->params->get("topPanelSwitch", "0");
$topPanelOpen = $this->params->get("topPanelOpen", "Open");
$topPanelClose = $this->params->get("topPanelClose", "Close");
$topPanelButtonWidth = $this->params->get("topPanelButtonWidth", "75");
$topPanelButtonHeight = $this->params->get("topPanelButtonHeight", "18");
$topPanelButtonBgColor = $this->params->get("topPanelButtonBgColor", "#000000");
$topPanelButtonTextColor = $this->params->get("topPanelButtonTextColor", "#FFFFFF");
$topPanelButtonTextSize = $this->params->get("topPanelButtonTextSize", "10");
$topPanelButtonBorderColor = $this->params->get("topPanelButtonBorderColor", "#666666");
$topPanelButtonBorderRadius = $this->params->get("topPanelButtonBorderRadius", "5");
$topPanelBgColor = $this->params->get("topPanelBgColor", "#000000");
$topPanelH3Color = $this->params->get("topPanelH3Color", "#CCCCCC");
$topPanelTextColor = $this->params->get("topPanelTextColor", "#CCCCCC");

// FONT RESIZE Settings --------------------------------------------------------------

$fontResizeMinus = $this->params->get("fontResizeMinus", "A-");
$fontResizeReset = $this->params->get("fontResizeReset", "Reset");
$fontResizePlus = $this->params->get("fontResizePlus", "A+");
$fontResizeImagesSwitch = $this->params->get("fontResizeImagesSwitch", "0");
$fontResizeMinusImage = $this->params->get("fontResizeMinusImage", "font_resize_minus.png");
$fontResizeResetImage = $this->params->get("fontResizeResetImage", "font_resize_reset.png");
$fontResizePlusImage = $this->params->get("fontResizePlusImage", "font_resize_plus.png");

// ANALYTICS Settings ----------------------------------------------------------------

$analyticsSwitch = $this->params->get("analyticsSwitch", "0");
$analyticsAccount = $this->params->get("analyticsAccount", "");

// GOOGLE FONTS Settings -------------------------------------------------------------

$googleWebFonts = $this->params->get("googleWebFonts", "");

// RESPONSIVENESS Settings -----------------------------------------------------------

$enableResponsive = $this->params->get("enableResponsive", "1");
$enableResponsiveMenu = $this->params->get("enableResponsiveMenu", "1");
$responsiveMenuTriggerValue = $this->params->get("responsiveMenuTriggerValue", "980");

?>