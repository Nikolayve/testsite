<?php
/*------------------------------------------------------------------------
# "Hot Full Carousel" Joomla module
# Copyright (C) 2013 HotJoomlaTemplates.com. All Rights Reserved.
# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
# Author: HotJoomlaTemplates.com
# Website: http://www.hotjoomlatemplates.com
-------------------------------------------------------------------------*/

defined('_JEXEC') or die('Restricted access'); // no direct access

// get the document object
$doc =& JFactory::getDocument(); ?>

<!-- Internet Explorer HTML5 fix -->
<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<?php

if($navArrows==2) {

$doc->addStyleDeclaration( '

.hero-carousel-nav {
    display: block !important;
}

' );

}

if (!$responsiveMode) { // if full width mode DISABLED

// add your stylesheet
$doc->addStyleSheet( 'modules/mod_hot_full_carousel/tmpl/style.css' );

// style declaration
$doc->addStyleDeclaration( '

.hero-carousel article {
    width: '.$moduleWidth.'px;
    height: '.$moduleHeight.'px;
}

.hero-carousel article .contents {
    top: '.$textAreaTop.'px;
    left: '.$textAreaLeft.'%;
    width: '.$textAreaWidth.'%;
    color: '.$textColor.';
    padding: '.$textAreaPadding.'%;
    -moz-border-radius: '.$borderRadius.'px;
    -webkit-border-radius: '.$borderRadius.'px;
    border-radius: '.$borderRadius.'px;
    background: rgba('.$boxBgColor.','.$boxTransparency.');
    -pie-background: rgba('.$boxBgColor.','.$boxTransparency.');
    font-size:'.$textSize.'px;
    behavior: url(modules/mod_hot_full_carousel/tmpl/PIE.php);
}

.hero-carousel article .contents h2 {
    font-size:'.$headingSize.'px;
}

' );

if($navArrows) {

$moduleWidthHalf = $moduleWidth / 2;

$doc->addStyleDeclaration( '

.hero-carousel-nav li {
    position: absolute;
    bottom: '.$arrowBottom.'px;
    right: '.$arrowSide.'px;
}
    
.hero-carousel-nav li.prev {
    left: '.$arrowSide.'px;
    right: auto;
}

.hero-carousel-nav li a {
    background: rgba('.$navBg.','.$navTransparency.');
    color: '.$navTextColor.';
    width: '.$navWidth.'px;
    height: '.$navHeight.'px;
    line-height: '.$navHeight.'px;
    text-align: center;
    font-size: '.$navTextSize.'px;
    -moz-border-radius: '.$navBorderRadius.'px;
    -webkit-border-radius: '.$navBorderRadius.'px;
    border-radius: '.$navBorderRadius.'px;
}

.hero-carousel-nav li a:hover { 
    background: '.$navBgHover.';
}

.hero-carousel-nav {
    width: '.$moduleWidth.'px;
    margin-left: -'.$moduleWidthHalf.'px;
}

' );

}

?>

<div class="hero">
    <div class="hero-carousel">
        <?php
            for ($loop = 1; $loop <= 20; $loop += 1) {
                if ($enableSlide[$loop]=="true") { ?>
                <article>
                    <?php if($imageLinkArray[$loop]) { ?><a href="<?php echo $imageLinkArray[$loop]; ?>" title="<?php echo $imageTitleArray[$loop]; ?>"><?php } ?>
                    <img src="<?php echo $mosConfig_live_site.'/'.$image[$loop]; ?>" alt="<?php echo $imageAlt[$loop]; ?>" width="<?php echo $moduleWidth; ?>" height="<?php echo $moduleHeight; ?>" />
                    <?php if ($imageHeading[$loop] || $imageText[$loop]) { ?>
                    <div class="contents">
                        <h2><?php echo $imageHeading[$loop]; ?></h2>
                        <?php echo $imageText[$loop]; ?> 
                    </div>
                    <?php } ?>
                    <?php if($imageLinkArray[$loop]) { ?></a><?php } ?>
                </article>
            <?php }
            } ?>
    </div>
</div>

<?php }else{ // if full width mode ENABLED

// add your stylesheet
$doc->addStyleSheet( 'modules/mod_hot_full_carousel/tmpl/style_responsive.css' );

// style declaration
$doc->addStyleDeclaration( '

.hero-carousel article {
    height: '.$moduleHeight.'px;
}

.hero-carousel article .contents {
    top: '.$textAreaTop.'px;
    left: '.$textAreaLeft.'%;
    width: '.$textAreaWidth.'%;
    color: '.$textColor.';
    padding: '.$textAreaPadding.'%;
    -moz-border-radius: '.$borderRadius.'px;
    -webkit-border-radius: '.$borderRadius.'px;
    border-radius: '.$borderRadius.'px;
    background: rgba('.$boxBgColor.','.$boxTransparency.');
    -pie-background: rgba('.$boxBgColor.','.$boxTransparency.');
    font-size:'.$textSize.'px;
    behavior: url(modules/mod_hot_full_carousel/tmpl/PIE.php);
}

.hero-carousel article .contents h2 {
    font-size:'.$headingSize.'px;
}

' );

if($navArrows) {

$moduleWidthHalf = $moduleWidth / 2;

$doc->addStyleDeclaration( '

.hero-carousel-nav {
    bottom: '.$arrowBottom.'px;
}
    
.hero-carousel-nav li {
    right: '.$arrowSide.'px;
    width: '.$navWidth.'px;
    height: '.$navHeight.'px;
}
    
.hero-carousel-nav li.prev {
    left: '.$arrowSide.'px;
}

.hero-carousel-nav li.next {
    right: '.$arrowSide.';
}
    
.hero-carousel-nav li a {
    background: rgba('.$navBg.','.$navTransparency.');
    color: '.$navTextColor.';
    width: '.$navWidth.'px;
    height: '.$navHeight.'px;
    line-height: '.$navHeight.'px;
    -moz-border-radius: '.$navBorderRadius.'px;
    -webkit-border-radius: '.$navBorderRadius.'px;
    border-radius: '.$navBorderRadius.'px;
}

.hero-carousel-nav li a:hover { 
    background: '.$navBgHover.';
}

' );

}

?>

<div class="hero">
    <div class="hero-carousel">
        <?php
            for ($loop = 1; $loop <= 20; $loop += 1) {
                if ($enableSlide[$loop]=="true") {
        ?>
        <article class="carousel-article" style="background-image:url(<?php echo $mosConfig_live_site.'/'.$image[$loop]; ?>); background-size:cover; background-position:top center">
            <?php if($imageLinkArray[$loop]) { ?><a href="<?php echo $imageLinkArray[$loop]; ?>" title="<?php echo $imageTitleArray[$loop]; ?>"><?php } ?>
            <?php if ($imageHeading[$loop] || $imageText[$loop]) { ?>
            <div class="contents">
                <?php if ($imageHeading[$loop]) { ?>
                <h2><?php echo $imageHeading[$loop]; ?></h2>
                <?php } ?>
                <?php echo $imageText[$loop]; ?>
            </div>
            <?php } ?>
            <?php if($imageLinkArray[$loop]) { ?></a><?php } ?>
        </article>
            <?php }
            } ?>
    </div>
</div>

<?php } // END IF ?>

<?php // LOADING SCRIPTS
if ($enablejQuery!=0) { ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<?php } if ($noConflict!=0) { ?>
<script type="text/javascript">
     jQuery.noConflict();
</script>
<?php } ?>
<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/modules/mod_hot_full_carousel/js/jquery.easing-1.3.js"></script>
<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/modules/mod_hot_full_carousel/js/jquery.heroCarousel-1.3.js"></script>
<script type="text/javascript">

    jQuery(document).ready(function(){

        /* calculates width of the carousel */
        var bodyWidth = jQuery('body').innerWidth();
        jQuery('.hero-carousel article.carousel-article').css('width', bodyWidth);

        jQuery('.hero-carousel').heroCarousel({
            <?php if($navArrows) { ?>navigation: true,<?php }else{ ?>navigation: false,
            <?php } ?>
            easing: '<?php echo $easing; ?>',
            css3pieFix: true,
            prevText: '<?php echo $arrowLeftText; ?>',
            nextText: '<?php echo $arrowRightText; ?>',
            animationSpeed: <?php echo $animSpeed; ?>,
            timeout: <?php echo $pauseTime; ?>,
            pause: true,
            pauseOnNavHover: true
        });

        <?php if($navArrows==1) { ?>
        jQuery('.hero').hover(function(){
            jQuery('.hero-carousel-nav').css('display','block');
        },function(){
            jQuery('.hero-carousel-nav').css('display','none');
        });
        <?php } ?>
    });
</script>