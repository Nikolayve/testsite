.container, .row {
<?php if(!$fluidWidth) { ?>
    width:<?php echo $templateWidth; ?>px;
<?php }else{ ?>
    width:100%;
<?php } ?>
}

[class*="span"] {
    margin-left: 0;
}

<?php
$cell_size = $templateWidth / 12;
if($fluidWidth) {
    $cell_size = 8.33333;
}else{
    $cell_size = floor($cell_size); 
}
$empty_no = 0;
foreach($module_grid as $gridRow){
//$gridRow[0] - Name
//$gridRow[1] - Class
//$gridRow[2] - ModulePos1,ModulePos2...
//$gridRow[3] - Holds content flag: true/false
    foreach($gridRow[2] as $mpostion){
    //$mpostion[0] - position name 
    //$mpostion[1] - number of grid cells occupied by position
    //$mpostion[2] - number of empty cells left of module
    
    $mpwidth = $cell_size * $mpostion[1];  
    $mpleft_off = $cell_size * $mpostion[2];  
    if( $mpostion[0] == "joom_content"){
        if($mpleft_off){
?>
.mp_empty<?php echo $empty_no; ?>{
    width:<?php echo $mpleft_off; if(!$fluidWidth) { echo "px"; }else{ echo "%"; } ?>;
}

<?php
            $empty_no++;
        }  
?>
.content_sparky {
    width:<?php echo $mpwidth; if(!$fluidWidth) { echo "px"; }else{ echo "%"; } ?>;
}

<?php
        }else{
            if($mpleft_off){
?>
.mp_empty<?php echo $empty_no; ?>{
    width:<?php echo $mpleft_off; if(!$fluidWidth) { echo "px"; }else{ echo "%"; } ?>;
}

<?php
                $empty_no++;
            } 
?>
.mp_<?php echo $mpostion[0];?>{
    width:<?php echo $mpwidth; if(!$fluidWidth) { echo "px"; }else{ echo "%"; } ?>;
}

<?php
        }
    }
}
?>