<?php
/*------------------------------------------------------------------------
# "Sparky Framework" - Joomla Template Framework
# Copyright (C) 2013 HotThemes. All Rights Reserved.
# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
# Author: HotThemes
# Website: http://www.hotjoomlatemplates.com
-------------------------------------------------------------------------*/?>
<script type="text/javascript" src="<?php echo $template_path ?>/js/font_resize.js"></script>
<div class="cell mp_<?php echo $mpostion[0];?>">
     <div class="cell_pad">
        <div id="font_resize">
        	<?php if($fontResizeImagesSwitch) { ?>
            <a class="decreaseFont" href="#" title="Font Decrease"><img src="<?php echo $template_path ?>/images/font_resize_minus.png" alt="smaller font"></a> <a class="resetFont" href="#" title="Font Reset"><img src="<?php echo $template_path ?>/images/font_resize_reset.png" alt="reset font"></a> <a class="increaseFont" href="#" title="Font Increase"><img src="<?php echo $template_path ?>/images/font_resize_plus.png" alt="larger font"></a>
            <?php }else{ ?>
            <a class="decreaseFont" href="#" title="Font Decrease"><?php echo $fontResizeMinus; ?></a> <a class="resetFont" href="#" title="Font Reset"><?php echo $fontResizeReset; ?></a> <a class="increaseFont" href="#" title="Font Increase"><?php echo $fontResizePlus; ?></a>
            <?php } ?>
        </div>
     </div>
</div>