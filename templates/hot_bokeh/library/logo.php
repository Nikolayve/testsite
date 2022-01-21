<?php
/*------------------------------------------------------------------------
# "Sparky Framework" - Joomla Template Framework
# Copyright (C) 2013 HotThemes. All Rights Reserved.
# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
# Author: HotThemes
# Website: http://www.hotjoomlatemplates.com
-------------------------------------------------------------------------*/?>
<div class="cell mp_<?php echo $mpostion[0];?> span<?php echo $mpostion[1];?>">
     <div class="cell_pad">
     		<?php if($logoImageSwitch) { ?>
            <div class="sparky_logo_image"><a href="index.php"><img src="<?php echo $template_path."/images/"; if (strpos($logoImageFile,'logo') !== false) { echo "$templateStyle"; } echo $logoImageFile; ?>" alt="<?php echo $logoImageAlt; ?>" /></a></div>
			<?php }else{ ?>
            <div class="sparky_logo"><a href="index.php"><?php echo $logoText; ?></a></div>
            <div class="sparky_slogan"><?php echo $sloganText; ?></div>
            <?php } ?>
     </div>
</div>