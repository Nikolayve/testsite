<?php

/*------------------------------------------------------------------------
# "Hot Maps" Joomla plugin
# Copyright (C) 2011 ArhiNet d.o.o. All Rights Reserved.
# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
# Author: HotJoomlaTemplates.com
# Website: http://www.hotjoomlatemplates.com
-------------------------------------------------------------------------*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.event.plugin');

class plgContentHotmaps extends JPlugin
{
	//Constructor
	//function plgContentHotmaps( &$subject )
	//{
		//parent::__construct( $subject );
		// load plugin parameters
		//$this->_plugin = JPluginHelper::getPlugin( 'content', 'hotmaps' );
		//$this->_params = new JParameter( $this->_plugin->params );
	//}

	function onContentPrepare($context, &$article, &$params, $page = 0)
	{
		// just startup
		global $mainframe;
		
		// checking
		if ( !preg_match("#{hotmaps}(.*?){/hotmaps}#s", $article->text) ) {
			return;
		}
		
		//$plugin =& JPluginHelper::getPlugin('content', 'hotmaps');
		//$pluginParams = new JParameter( $plugin->params );
		
		// Parameters
		$satellite = $this->params->def('satellite', 0);
		$link_enable = $this->params->def('link_enable', 1);
		$link_text = $this->params->def('link_text','View Larger Map');
		
		if (preg_match_all("#{hotmaps}(.*?){/hotmaps}#s", $article->text, $matches, PREG_PATTERN_ORDER) > 0) {
			$hotmapscount = -1;
			foreach ($matches[0] as $match) {
				$hotmapscount++;
				$hotmaps_input = preg_replace("/{.+?}/", "", $match);
				$hotmaps_params = explode(",", $hotmaps_input);
				
				$keywords = explode(" ", $hotmaps_params[0]);
				$keywords_number = count($keywords);
				$keywords_number_1 = $keywords_number - 1;

				$html = '<!-- HOT Maps Plugin starts here -->';
				$html.='<iframe width="'.$hotmaps_params[1].'" height="'.$hotmaps_params[2].'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?q=';

				for ($loop = 0; $loop < $keywords_number; $loop += 1) {
					$html.= $keywords[$loop];
					if($loop!=$keywords_number_1) {
						$html.=  "+";
					}
				}

				$html.= '&amp;ie=UTF8&amp;view=map&amp;f=q&amp;saddr=';

				for ($loop = 0; $loop < $keywords_number; $loop += 1) {
					$html.= $keywords[$loop];
					if($loop!=$keywords_number_1) {
						$html.= ",+";
					}
				}

				$html.= '&amp;';
				if($satellite) {
				$html.='t=h&amp;';
				}
				$html.='output=embed"></iframe>';
				
				if($link_enable) {
					
					$html.= '<br /><small><a href="http://maps.google.com/maps?q=';
	
					for ($loop = 0; $loop < $keywords_number; $loop += 1) {
						$html.= $keywords[$loop];
						if($loop!=$keywords_number_1) {
							$html.= "+";
						}
					}
	
					$html.= '&amp;ie=UTF8&amp;view=map&amp;f=a&amp;saddr=';
					
					for ($loop = 0; $loop < $keywords_number; $loop += 1) {
						$html.= $keywords[$loop];
						if($loop!=$keywords_number_1) {
							$html.= ",+";
						}
					}
	
					$html.= '&amp;';
					
					if($satellite) {
					$html.= 't=h&amp;';
					}
					
					$html.= 'output=embed" style="color:#0000FF;text-align:left">'.$link_text.'</a></small>';
				
				}
			
			$article->text = preg_replace( "#{hotmaps}".$hotmaps_input."{/hotmaps}#s", $html , $article->text );	
			
			}
		}
	}
}