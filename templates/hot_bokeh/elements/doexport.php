<?php
/*------------------------------------------------------------------------
# "Sparky Framework" - Joomla Template Framework
# Copyright (C) 2013 HotThemes. All Rights Reserved.
# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
# Author: HotThemes
# Website: http://www.hotjoomlatemplates.com
-------------------------------------------------------------------------*/

define( 'YOURBASEPATH', getcwd(). DIRECTORY_SEPARATOR. '..' );

function do_copy($src,$dst,$replaces) { 
    $dir = opendir($src); 
    $res = mkdir($dst); 
	if(!$res)
	  return $res;
	  
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . DIRECTORY_SEPARATOR . $file) ) { 
		  if( $file != 'export')
			 do_copy($src . DIRECTORY_SEPARATOR . $file,$dst . DIRECTORY_SEPARATOR . $file,$replaces); 
            } 
            else { 
			    $new_fname = $file;
				
				if(!empty($replaces)){
				  $i = 0; 
				  for($i = 0; $i < count($replaces);$i+= 2){
				      $new_fname = str_replace($replaces[$i], $replaces[$i + 1], $new_fname);
				  }
				}
				
                copy($src . DIRECTORY_SEPARATOR . $file,$dst . DIRECTORY_SEPARATOR . $new_fname); 
            } 
        } 
    } 
    closedir($dir); 
	return true;
}

function namechange($file,$newname){
$alias  = str_ireplace(' ','_', $newname);
$alias  = strtolower($alias);
$aliasU = strtoupper($alias);
$nameL  = strtolower($newname);
$nameU  = strtoupper($newname);

$content = @file_get_contents($file);
if($content) {
	$content = str_replace('hot_bokeh', $alias, $content);
	$content = str_replace('HOT_BOKEH', $aliasU, $content);
	$content = str_replace('hot_bokeh', $nameL, $content);
	$content = str_replace('HOT_BOKEH', $nameU, $content);
	$content = str_replace('hot_bokeh', $alias, $content);
	$content = str_replace('HOT_BOKEH', $aliasU, $content);
	$content = str_replace('hot_bokeh', $newname, $content);
	$content = str_replace('hot_bokeh', $newname, $content);
	$content = str_replace('hot_bokeh', $newname, $content);
	@file_put_contents($file,$content);
}

}


function do_zip($zipf,$src,$path) { 
    $dir = opendir($src); 
    
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . DIRECTORY_SEPARATOR . $file) ) { 
			    $p = $path. DIRECTORY_SEPARATOR . $file;
			    $zipf->addEmptyDir($p);
			    do_zip($zipf,$src . DIRECTORY_SEPARATOR . $file,$p); 
            } 
            else {
			    
			    $zipf->addFromString($path. DIRECTORY_SEPARATOR .$file, file_get_contents($src. DIRECTORY_SEPARATOR .$file));
            } 
        } 
    } 
    closedir($dir); 
	return true;
} 


function do_name_change($src,$newname) { 
    $dir = opendir($src); 
    
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . DIRECTORY_SEPARATOR . $file) ) { 
			    do_name_change($src . DIRECTORY_SEPARATOR . $file,$newname); 
            } 
            else {
			    $ext = strtolower(end(explode('.', $file)));
				if($ext == "xml"
				   ||
				   $ext == "php"
				   ||
				   $ext == "ini"
				   ||
				   $ext == "css"
				   ||
				   $ext == "js"
				   ||
				   $ext == "htm"
				   ||
				   $ext == "html")
					namechange($src . DIRECTORY_SEPARATOR . $file,$newname); 
            } 
        } 
    } 
    closedir($dir); 
	return true;
} 



$template_name = $_REQUEST['SPARKY_EXPORT_NAME'];
$alias_name = str_ireplace(' ','_', $template_name);
$alias_name = strtolower($alias_name);


$sparky_path = YOURBASEPATH;

if(!is_dir(YOURBASEPATH.DIRECTORY_SEPARATOR.'export'))
   if(!mkdir(YOURBASEPATH.DIRECTORY_SEPARATOR.'export')){
     echo "Can not create directory: ".YOURBASEPATH.DIRECTORY_SEPARATOR.'export';
	 return;
   }


$export_path = YOURBASEPATH.DIRECTORY_SEPARATOR.'export'.DIRECTORY_SEPARATOR.$alias_name;


$name_rep= array(
 'hot_bokeh',$alias_name,
 'hot_bokeh',$alias_name
);

$success = do_copy($sparky_path,$export_path,$name_rep);

mkdir($export_path.DIRECTORY_SEPARATOR.'export');
@file_put_contents($export_path.DIRECTORY_SEPARATOR.'export'.DIRECTORY_SEPARATOR.'index.html',"<html><div></div></html>");

if(!$success){
 echo 'Could not create directory:'.$export_path;
 return;
}

do_name_change($export_path,$template_name);

$template_details_path = $export_path.DIRECTORY_SEPARATOR.'templateDetails.xml';

$settingXML = simplexml_load_file($template_details_path);

foreach($settingXML->config->fields->fieldset as $fieldset){
	foreach($fieldset->field as $field){
	       if($field["name"] == "SPARKY_EXPORT_NAME") continue; 
		   $val = $_REQUEST['jform']['params'][$field["name"].''];
		   if($val){
		     $field["default"] = $val;
		   }
	}
}


@file_put_contents($template_details_path,$settingXML->asXML());


$zip_file = $export_path.'.zip';

//echo 'Created directory: '.$export_path;
	


try{

    if (!extension_loaded('zip') || !file_exists($export_path)) {
	   return false;
	}


	$zip = new ZipArchive();
	if (!$zip->open($zip_file, ZIPARCHIVE::CREATE)) {
		return;
	}
	
	
	do_zip($zip,$export_path,"");
 	
	$zip->close();
    echo 'OK|'.$alias_name.'.zip';	

}catch(Exception $ex){
    var_dump($ex);
}







?>