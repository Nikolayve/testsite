<?php defined('_JEXEC') or die(); ?>

=====================================================================
Hotspots 5.2.1 - Released 18-December-2015
=====================================================================
# update script was not automatically updating the Hotspots config, leading to the Hotspots not loading in frontend
# CB plugin was showing undefined for title of the hotspot
# wrong redirect when SEF urls are turned off and there is an error in the hotspots submit form

=====================================================================
Hotspots 5.2.0 - Released 17-December-2015
=====================================================================
# joomla 3.4.6 bug - when saving a hotspot in frontend without a description one is redirected to the startpage instead of the form
# the page was automatically scrolling to hotspots (on long pages this is not desirable)
# the tour was not working properly when the menu was starting closed
# single view of a hotspot was not responsive
+ now saving & showing the state in the US interface
- removed sensor parameter from the URL as it is no longer required by google maps
+ the search now looks for hotspots in 50km radius if nothing is found in the current view and then around the globe
+ added a new user hotspots view that can be used from moderators to edit the hotspots in the frontend
# fixed bug with resizing PNG images
+ added option to add OGP(Open Graph) information without the need to have the share buttons
+ batch operations in backend (duplicate, move, change access level, change category
+ the hotspots now have an alias field (will be used for the url)
+ added an option to save and create new hotspot (without going back to the hotspots view) in the backend
+ custom fields are now visible on the map view (requires an update to your html overrides json view if you have any)
# the submit form could be sent several times when you click the submit button several times
# a wrong created_by id was set when editing a hotspot as an administrator in the frontend
+ show "no hotspots found" in the user hotspots view, when the user doesn't have any hotspots
+ added edit & delete buttons to a single view of a hotspot (only when the necessary edit/delete rights are set)
+ added new Plugin events onMultimediaBeforeUpload & onMultimediaAfterUpload
+ filter by language in the backend
+ added google recaptcha v2 for the frontend submit form
+ Make an option to select if you want to show username or name
+ Auto-set the map language depending on the site language
# moderators were not able to delete hotspots in the frontend
# update from version 3.x was not deleting all helper files, leading to errors in the dashboard
+ category title and description can be translated in a different language.
+ the hotspots anywhere plugin supports providing a menu item id {hotspotsanywhere Itemid} or {hotspotsanywhere lat/lng/zoom | Itemid}
# Wrong query in the hotspots mappings
# The My Location pin was not translated
# aup plugin was installed in the wrong category
# the aup plugin was not assigning any points
# wrong redirect after deleting a hotspot in the frontend when SEF is on
# adding a confirm dialog to the delete own hotspots button in frontend

=====================================================================
Hotspots 5.1.11 - Released 27-August-2015
=====================================================================
# the message to the owner of a Hotspot was stripped of spaces
# custom marker icon was not shown in single view of a hotspot
+ the Matukio plugin now ads the publish_down date of the event
# some update queries were missing and updating from old version such as 2.0.5 was not possible because of this
# .compojoom-bootstrap class was missing from the single hotspot view page
# changed the default quality for the generated thumbs. Now they should have smaller size than the original image :)
# the custom fields label were not correctly aligned
# KML import option now supports unlimited Folder depth for Placemarks
+ frontend user hotspots now has a filter for search state, list length + an option to delete own hotspots
+ added an option to map Matukio categories to Hotspot categories
* no language was set in the frontend & because of this the hotspot was not shown on multilingual sites
+ added a map background option
# fixes to the CB plugin
# image upload resizing was not working on Chrome browser
+ the galleria now goes in fullscreen on double click
# in single view we set the title of the page to the hotspots title & the site name
+ fb share now shows the correct title, description & image( if available) and sets lat & lng coordinates
+ g+ share now shows the correct title, description & image( if available) and sets lat & lng coordinates

=====================================================================
Hotspots 5.1.10 - Released 08-June-2015
=====================================================================
# the weather layer was showing up on the map per default, despite being turned off

=====================================================================
Hotspots 5.1.9 - Released 02-June-2015
=====================================================================
# Submit map was no longer working on Joomla 2.5 (this is also going to be the last release supporting joomla 2.5)
# when the weather layer was enabled the map on the submit page was not working

=====================================================================
Hotspots 5.1.8 - Released 01-June-2015
=====================================================================
^ switching the weather layer to http://openweathermap.org (Google has deprecated it's own weather layer and it will stop working on the 4th of June 2015)
- removed the clouds layer (as Google deprecated it and they it will stop working on the 4th of June 2015)
- removed the panoramio layer (as Google deprecated it and they it will stop working on the 4th of June 2015)
# the jomsocial links profile was no longer generating correct urls to the user's profile
# the community - hotspots plugin was no longer working on Jomsocial 4
+ added recaptcha to the contact author of a Hotspot form
+ added an option to the k2 plugin to delete an existing hotspot directly from the k2 item
# jomsocial features plugin was not working properly with Jomsocial 4.x
+ added a feature to send a mail to the author of a Hotspot
# the hotspots - k2 now supports swtabs
# set correct orientation for the generated thumbs

=====================================================================
Hotspots 5.1.7 - Released 27-April-2015
=====================================================================
# dashboard was not loading when ccomment 5.3.3 was installed on the site
# fixed reordering issue with custom fields

=====================================================================
Hotspots 5.1.6 - Released 23-April-2015
=====================================================================
+ option to gather anonymous stats about the environment & configuration of the extension

=====================================================================
Hotspots 5.1.5 - Released 13-April-2015
=====================================================================
+ added JED review request on the dashboard
# if we are in category list view look for the presence of the {hotspots} tag only in the introtext field
+ The create hotspots menu now has a default categories option. You can specify which categories are visible in the frontend with it.
# output friendly warning when a hotspot is linked to unexisting matukio entry
# sometimes the tabs in teh menu were executing ajax requests due to a jquery ui "feature"
# hardcoded 'Select category' in the frontend submit form
# Hack around joomla bug: https://github.com/joomla/joomla-cms/pull/6440

=====================================================================
Hotspots 5.1.4 - Released 6-April-2015
=====================================================================
# warning when address was missing in single view
# center by marker boundaries was not working

=====================================================================
Hotspots 5.1.3 - Released 1-April-2015
=====================================================================
# Parse error: syntax error, unexpected T_OBJECT_OPERATOR for people on PHP 5.3 on single view. Users running PHP 5.4 were not affected

=====================================================================
Hotspots 5.1.2 - Released 1-April-2015
=====================================================================
# Updating from any version previous to 5.0 would cause a mysql error

=====================================================================
Hotspots 5.1.1 - Released 31-March-2015
=====================================================================
# Parse error: syntax error, unexpected T_OBJECT_OPERATOR for people on PHP 5.3. Users running PHP 5.4 were not affected

=====================================================================
Hotspots 5.1.0 - Released 31-March-2015
=====================================================================
+ multiple images upload
+ use of gallerio.io to show the images in frontend (with fullscreen support!!!)
+ new submit hotspot view in frontend
~ single hotspot view no longer relies on mootools
# readmore was shown even though the option in the hotspot was set to no

=====================================================================
Hotspots 5.0.5 - Released 25-February-2015
=====================================================================
# load the correct language for facebook recommend plugin
# Joomla search plugin was not returning the correct results
# jomsocial, matukio & k2 plugins were unable to select a Hotspots category
# fixed sobiPRO import
# selecting start and end date in the frontend was not visible due to css bug
# on Joomla 2.5 one was not able to delete any hotspots in the backend
# map on dashboard was not showing the markers

=====================================================================
Hotspots 5.0.4 - Released 30-January-2015
=====================================================================
+ KML import now import files that don't have a document node
+ KML import now has a default category option
# in some cases the installation was failing on joomla 2.5
# uploading a category marker icon was not working
+ it's now possible to seach for more than one hotspot by id in the backend syntax: id: 28,29 etc
# fire onContentChangeState event when a hotspot gets published/unpublished

=====================================================================
Hotspots 5.0.3 - Released 26-January-2015
=====================================================================
# category icon selection was not working when JSN power admin was enabled
# when category filter was selected KML files were not being loaded due to wrong query
# when the content - categories plugin was enabled one was not able to save hotspots, articles, categories or upload media :(

=====================================================================
Hotspots 5.0.2 - Released 22-January-2015
=====================================================================
# the publish/unpublish button in the toolbar was not working in hotspots view in backend
# editing categories on joomla 2.5 was not possible
# on some sites the marker icons were not loading
# on joomla 2.5 the content and k2 plugins were crashing the page rendering
# possible page crash when using meta description & keywords
# the single hotspot selection was showing few notices
# locations view was not loading on joomla 2.5
# deleting a hotspot in the backend was resulting in a php error after the deletion
# kml import was no longer working correctly with the new category manager
# wrong link to the categories in the installation quick links.

=====================================================================
Hotspots 5.0.1 - Released 21-January-2015
=====================================================================
# Due to a wrong category check users were not able to create new Hotspots in the backend

=====================================================================
Hotspots 5.0.0 - Released 21-January-2015
=====================================================================
+ when selecting a parent category automatically select all children
~ The tile cache has been moved to joomla's cache folder
^ Using Joomla's Category Manager. Now supporting subcategories!
# marker tiles were not loaded on joomla 2.5
~ changed the default message that displays when you haven't provided a download id
+ kml import now also support StyleMaps definitions in the KML file
# CB plugin - if the user is blocked, not approved, not confirmed or banned then remove his location from the map
+ the latest hotspots module has an option to show/hide the author and date
# the mail notify plugin was sending the same email X times to each user (where X is the number of moderators (facepalm))
# the email notify plugin was sending emails to blocked accounts
# reverse geocoding location in the backend was working only for 1 item and for multiple items
# imported KML locations were not being shown on the map due to a missing language value
+ added EasySocial avatar and profiles support
# map not working on Ipad in fullscreen mode
+ added an option to show the coordinates in the PRO version
~ share map & rss is per default disabled in the core version
~ when a custom field is not filled out don't show it
# kml import on joomla 2.5 was not working properly
+ added a module class suffix support to the latest hotspots module
# javascript error when changing direction's to/from in the hotspots marker
+ the matukio integration can now also use the locations define in matukio for each event

=====================================================================
Hotspots 4.3.3 - Released 19-December-2014
=====================================================================
# submitting a hotspot in the backend was not working under joomla 2.5

=====================================================================
Hotspots 4.3.2 - Released 18-December-2014
=====================================================================
# submission form was not working in the frontend

=====================================================================
Hotspots 4.3.1 - Released 15-December-2014
=====================================================================
# customfields assigned to specific categories couldn't be loaded in the hotsptos create view

=====================================================================
Hotspots 4.3.0 - Released 15-December-2014
=====================================================================
+ improved Matukio integration. Now the link to event leads to the new dates view where the user can select a date repeating event
+ added option to show latitude and longitude in the frontend
- removed print map option as it was not working since the 4.0 version. Will introduce it back in 4.5
+ the content - hotspots plugin now also works in jevents
# Address is not displayed correctly
# zoom not working in the div at the bottom of the map (when menu is turned off)
- removed the loading data indicator near the cursor
+ added the hotspotsanywhere plugin. It allows you to include the main hotspots view in a module position or in an article
~ the custom fields code has been abstracted and moved to lib_compojoom (have a look at your configured custom fields, you might need to reapply any category relationships)
# custom fields data is now output event for unpublished events
# saving a hotspot with wrong data was not outputing any error information

=====================================================================
Hotspots 4.2.4 - Released 24-November-2014
=====================================================================
# on some installations the configuration was crashing
# when the title was too long and there was an image, the title was slipping to a new row

=====================================================================
Hotspots 4.2.3 - Released 23-November-2014
=====================================================================
# on joomla 2.5 the dashboard was crashing on some installations

=====================================================================
Hotspots 4.2.2 - Released 23-November-2014
=====================================================================
# K2 plugin was not working with custom zoom level
+ added option to toggle the states (open, clsoe) of streetview by clicking on the streetview image
+ added avatar support for CB, Jomsocial, Kunena and K2
+ added profile support for CB, Jomsocial, Kunena and K2
# fontawesome icons for directions search were not loading when emulate bootstrap was on
# map width was not correct when menu was set to start closed
# the menu arrow was not correct when the menu was set to start closed

=====================================================================
Hotspots 4.2.1 - Released 11-November-2014
=====================================================================
# wrong center when we had coordinates in the url
# wrong offset leading to inability to load hotspots when a filter is selected

=====================================================================
Hotspots 4.2.0 - Released 10-November-2014
=====================================================================
- remove the installer - hotspots plugin from the core version
# on some installations the dashboard was crashing
# Show correct message when saving a hotspot in the frontend and autopublish is set to off
# list length parameter was not taken into account (the menu list had always 20items...)
# when tabs title is turned off don't show information how to change the tabs...
+ added an option to turn off the streetview when a hotspot is selected in the menu list
+ added a new custom field: url
# when users don't have any markers in a category, always use the default map center
# wrong tiles generated when no cats filter provided
# centering by marker bounds was not working properly
# wrong catid was used when there was no k2catid=hotspotcatid mapping in the k2 - hotspots plugin
# Map doesn't respect the map type options in backend
# the rss feed is now cached in joomla's cache folder and not in hotspots media folder
# k2 items were saving the hotspot with wrong coordinates (lat & lng were mixed up)
# allow empty in custom fields options was not respected
# map in the dashboard was cut off
+ Hotspots is now fully responsive. Works on small screens(iphone, windows Phone, android)
# fixed issues with the tour when tabs are disabled
~ making the css a little more bulletproof for templates that are not well written
# emailing the map was not working when the user was not logged in

=====================================================================
Hotspots 4.1.1 - Released 21-October-2014
=====================================================================
# fixed Jomsocial activity plugin was no longer adding activity to jomsocial
# fixed warning on filters view

=====================================================================
Hotspots 4.1.0 - Released 20-October-2014
=====================================================================
+ added option to emulate bootstrap for templates that don't come with support for the framework
+ enter now triggers the direction search in the hotspots list
+ added an option to hide the tab title
+ when no tab is selected for the menu, we now show the information about the hotspot in a div on top of the map
+ added options to select which tab to show in the menu
# the menu closed option was not taken into account
# the k2 plugin was not properly centering the marker
# the k2 plugin was creating a fatal error
~ moved all helper files to the frontend /helpers folder
^ Renamed hotspotsHelper to HotspotsHelperSettings - this might break your template overrides, so make sure to update them!
# hotspots were not properly loaded on multilingual sites
+ hotspots_above_filter & hotspots_below_filter module positions allowing you to display additional info to your users when they click on filters
+ onBeforeBuildQuery & onAfterBuildQuery events for developers who want to manipulate the list of hotspots
$ added missing translations
~ made the css a little more bulletproof against badly written templates and extensions
^ Switching to the Handlebars.js template framework - you'll need to update your template overrides
+ added import locations from KML file
# page class & page heading options in page display in the menu were not respected

=====================================================================
Hotspots 4.0.6 - Released 10-October-2014
=====================================================================
# tooltips on the filters were cut off
# reorder the toolbar buttons in category view to follow the joomla standard 3.x behavior
+ adding fb, twitter & google plus share button on single view of a hotspot
# on some installations users were not able to upload KML files
# the k2 plugin was missing the javascript file
# tour navigation buttons were not translated
# directions search from hotspots list was not working
^ changed syntax of underscore js templates - we now use {{ }} instead of <% %> - Make sure to update your overrides!
~ code cleanup
# reloading update information was not working on joomla 2.5
# kml files were not loaded when no category was selected
^ changed the k2 integration behave. Now the fields support geocoding
# category ordering was not respected
# start map in fullscreen was not working

=====================================================================
Hotspots 4.0.5 - Released 05-October-2014
=====================================================================
# forgotten console.log output
# hotspots were not loading because of a missing tooltip library on some joomla installations
+ added new module positions. Check docs on compojoom.com for more details

=====================================================================
Hotspots 4.0.4 - Released 03-October-2014
=====================================================================
# on update the modified_by table field was not created, due to a typo in the mysql file
# jquery ui tabs can load content using ajax, which screws hotspots if the url contains a query...
# hardcoded language strings
~ language file cleanup
~ removed unused code
~ code cleanup

=====================================================================
Hotspots 4.0.3 - Released 30-September-2014
=====================================================================
# when there is no filter set, make sure that we look only for hotspots in published categories
# hotspots now respect the address settings
# show author and date settings were having no effect
# marker count was not taken into account
# hardcoded language strings in the map view
# truncating the short description was creating issues with html code

=====================================================================
Hotspots 4.0.2 - Released 29-September-2014
=====================================================================
# wrong sql syntax in a query on the dashboard
# dashboard buttons were missing icons on joomla 2.5
- removed option to hide categories on top (as we no longer have the categories on top)
# map was not respecting the centering method selected by the user
# styled maps was not working on some installations

=====================================================================
Hotspots 4.0.1 - Released 27-September-2014
=====================================================================
# old install definitions in the hotspots.xml were preventing it from installing (update was working)
# the complete_uninstall option was not respected when uninstalling the component

=====================================================================
Hotspots 4.0.0 - Released 24-September-2014
=====================================================================
+ Now using joomla's updater for updating core & pro versions
- Removing the liveupdate library as we rely on joomla for updates now
# Change arrow direction when menu opens
# When menu is closed and the user clicks on a hotspot -> open it and center on this hotspot
# menu was not closing on IE11
+ added pagination on top of the list in the menu

=====================================================================
Hotspots 4.0.0 beta1 - Released 27-August-2014
=====================================================================
# still using mootools functions on some places
# using the new sql installer. Now updates from dev to stable, from stable to dev are no longer an issue. Downgrades as well!!! yahoo!
~ now using our backend template
- removed the old controlcenter and all backend modules
+ added new dashboard
# added map to the k2 item submit view (now user can use a drag and drop marker to specify the location + we have street, city, zip, country) fields
# custom fields were crashing, because values were not escaped.
+ new hotspots view - new directions, hotspots & settings
# fixed bug in the SobiPro migrator
+ added option to add text above and below the map (in the map menu)
=====================================================================
Hotspots 3.6.2 - Released 17-March-2014
=====================================================================
# could not create a map menu on Joomla 2.5
=====================================================================
Hotspots 3.6.1 - Released 12-March-2014
=====================================================================
# fixed - wrong group for k2 plugin
=====================================================================
Hotspots 3.6.0 - Released 5-March-2014
=====================================================================
# fixed - wrong redirect when using SEF and wrong captcha was entered in the form in the frontend
# fixed - content plugin was not using the custom image
+ added an option to override the hotspots settings in the menu
+ added k2 plugin that would add a pin for a k2 entry. It also displays a map after the k2 entry
+ added jomsocial plugin to add a pin for the user's address on the map
+ adding a matukio plugin that can publish the events on the hotspots map
+ added an option to unpublish the hotspot created through CB, instead of deleting it
# the cb plugin was not properly deleting the hotspots mappings
+ added the compojoom library to the package
+ added id column to the hotspots view in the backend
# TypeError: 'undefined' is not an object (evaluating 'b.getNorthEast')
# centering in single view was not working properly in some situations
+ updated the CB plugin with an option to set the title of the hotspot and to define mappign between hotspots custom fields and cb custom fields
+ added the option to geocode the address of a CB user and to add his location in a specific category in Hotspots
# the map controls were not changeble (no position or style could be set)
~ powered by cannot be changed from the settings for the core version anymore
+ added hotspots_search_tab position (in the menu directly after the directions form)
+ adding the ability to show modules in the menu (hotspots_top_category_ID && hotspots_bottom_category_ID positions, where ID is the ID of the category where modules should be shown)
# the copied link was not working on safari browser
# auto-resize the infowindow whenever the user changes the map dimentions
+ added list type for the custom fields
# treat the c argument in the url as lat & lng & not as a string for the geocoder
# style the userhotspots view on joomla 3.0
+ adding a no matching result message when there are no hotspots
# making the sobiPro improt script compatible with the latest sobiPro version 1.1.5
# customfields were not working on j2.5
# send map & print map was not working in some situations
- removing unused files
# the update script wasn't properly updating the custom fields
# generating unique file names for images. Otherwise they can end up being overridden by accident
+ added custom fields support to the hotspots form
+ added backend config screen for customfields
# Selecting single hotspot from the menu was not that easy as it was buggy...
# recaptcha was loaded over http connection on https sites
# infobubble was loading resources over http:// instead of https://
# helper was not defined in the CB plugin
# load the correct url for the CB plugin
# the google api was not loaded through https in the CB plugin
=====================================================================
Hotspots 3.5.x - Released 7-July-2013
=====================================================================
# panoramio user id needs to be stored as a string and not an integer
+ search now auto zooms out when we have hotspots outside of the current view
# prevented scrolling the map, when using scroll in the infowindow in firefox
# the hotspots list module had hardcoded language strings in the code
~ removed the back link in single view - users are supposed to use the browser's back button (that is why we have it!!!)
# complete_uninstall was not taken into account
# fixed a redirect issue when submitting on the frontend
~ switch to the curl class for the geolocation feature
~ sobiPro import can now import more than 1000 locations
# the jomsocial plugin was not working properly
# on some servers the uploaded images have wrong permissions. Now manually setting them to 0644
# on some installation uploading a marker image was causing a fatal error
# infoBubble was not opening when in panorama view
# fixing a crash with IE8 when the hotspot had an image
# quick-search was not working when the menu was hidden
# in some situations a fatal error on j3 when creating a category
# infobubble problems with IE8
# if we use geolocation centering it creates problem for single view of hotspots
# language improvements in the menu options (otherwise we had untranslated strings)
# the sys. language file was not loading available translations
# error in the language file
# show all tabs on map was not working propery
# in some situations changing categories was not working properly in frontend
# welcome message was wrong right after the installation when the configuration was never saved
# when importing from sobipro the access field was not properly set
# sorting was not working properly in backend marker view
# fixing XSS vulnerability in the mail function
# insufficient escaping leads to a possible SQL injection 2
# insufficient escaping leads to a possible SQL injection
# users with editState permissions were not able to change the hotspots published state in the frontend
# search was not working when the string we were searching for was containing "id"
# when we had a multilingual site the infowindow was making 2 requests to show the data instead of 1
~ changed link to the JED for the core version
# when using the search the menu was always showing up even though the user has closed it
~ content plugin is now only executed on featured view if we have the code in the introtext
+ added option for width to the content plugin
+ added option for zoom to the content plugin
# hotspots adding now per default uses the center & zoom set in the global config
# RSS was not working on joomla 3 & with php strict mode on
# cannot select FAHRENHEIT as temperature unit for the weather layer
+ added latest hotspots module
+ Link author to jomsocial, CB etc
# KML was not respecting the state of a KML file (published, unpublished)
~ KMLs now are cleared when we switch between categories
# it was not possible to save a sample image for the category
# select "show all tabs on map" was refreshing the map instead of showing all the tabs on the map...
+ added AUP plugin
+ added option to execute the content plugin in K2
- removed the category shadow as the latest google maps API has deprecated it and it is no longer available in the visual refresh
+ added option to exclude a category from frontend submission
# the markers on the custom tiles were not clickable
# Infobubble - hiding markers when we use single instance of Infobubble - more info: https://code.google.com/p/google-maps-utility-library-v3/issues/detail?id=264
# wrong values for boundary and default centering
+ added an option to set a custom zoom level when centering using the user's location
+ added high accuracy option to the user's geolocation (this will use HTML5 geolocation)
+ added an option to center the map using the user's location (based on IP)
+ adding a show readmore option for each hotspot in the backend
# markers were disappearing on the map when first clicked
~ the markerImage class deprecated in the last version of google Maps API, so moving to the new icon class
# on IE searches that contain UTF8 characters don't return any results
# destroying the infobubble from the dom when we close it
~ turned on autopan for the infobubble
# when the menu was hidden we could not resize the map
~ moved some options to the map tab where they fit better
+ added configuration option for Pan Control
+ added configuration option for Zoom Control
+ added configuration option for Map type Control
+ added configuration option for Scale Control
+ added configuration option for Street view Control
+ added configuration option for Overview map Control
+ added configuration option for Scrollwheel Control
# a notice was display on the form view in frontend when we had a picture
# CB plugin was not displaying the infowindows and markers on the map
+ added an option to hide the menu on the right on start
+ added an option to hide the quick search form
+ added an option to hide the directions button for the marker
=====================================================================
Hotspots 3.4.x - Released 6-May-2013
=====================================================================
# no spaces when showing the user name
# clicking on a marker in the menu was not working on iphone/ipad
+ added plugin to link to Flexicontent
+ added plugin to link (read more) hotspots to external sites
+ added draggable directions option
+ added an option to provide API key & always using an https url to load the map
+ added the visualRefresh option
# fixed - height of infowindow content was bigger than the height of the container
+ added an option to hide the zoom button
# map in single view was not loading properly when the weather api was on
# address was not properly formatted on some places
+ added panoramio layer support
+ added bicycling layer support
+ added transit layer support
+ added traffic layer support
+ added weather api support
+ added clouds layer support
# the hotspots order setting was not having any effect
+ added fullscreen map option
# show author option was missing
+ adding reverse geocoding option in the backend
# the color picker for custom tile marker was not working on joomla > 3
# added filter="raw" to the styled map textarea
# the joomla installer cannot copy empty folders and shows a warning. Adding index.html file to the kml folder because of that
# fixed - the content plugin is now only executed when we have the appropriate context. Otherwise we get a high performance penalty
# date_format was of wrong type
# the geocoder feature in the backend was not working
# sending a mail about new hotspots to moderators was not working
# added missing GPL licenses to some files
# some layout improvements in the backend of joomla 3/3.1
+ added styled maps feature
# fixed PHP strict warning when creating a hotspot
# user was not able to edit their hotspots in frontend even if the edit.own permission was set
# fixing the CB plugin - should now work on joomla 3
# read more link was wrong in search results
~ updated the ccomment plugin integration to be compatible with ccomment5
# a language string was not translated in the javascript
# links to k2 were not SEF
# deleting tiles was not functioning on joomla 3
+ added hotspots-fullscreen class to the body when in fullscreen (allows template devs to hide elements)
# the countmarkers function was not properly working on joomla3
# fixed KML was not working properly on j3
# more php strict fixes
# language for each hotspot is taken into account when we present it in the frontend
# fixing some php strict warnings in the router
# frontend marker picture upload setting was not taken into account
# the title of the hotspot in single view was not shown
# when saving hotspot on microsoft server the publish_down date was incorrectly set to the current date of saving
# content - Hotspots plugin is now compatible with joomla 3.0
+ adding SQL SERVER compatibility
# some layout issues with the installer on Joomla 3.0
+ adding a copy link button
~ category-shadow is now required in the category settings
+ adding metadata information on map view
# map was not refreshing the locations properly when the search tab was selected
# fixed layout issues on joomla 3.0
# date was not respecting the format setting on the maps view
# fixed a bug with the jomsocial plugin
# some hotspots were not shown on the map and in the menu (bug introduced with the new sorting)
# the check all button in backend was not functioning properly on j3.0
# search by street/country/town was not working - thanks to Grazing Cat .Inc for providing us with a fix
# sorting hotspots by name ASC in the menu
# single hotspots was not rendered when ccomment was selected in the options, but it was not actually installed on the user's site
# sql error when hotspots order is set to created time
~ the install script not allows the installation only on joomla >= 2.5.6
# userhotspots was not working on joomla 3.0
# the map was missing from "submit-hotspots" view in the frontend on joomla3
# readmore was showing in the menu even though "Marker detailpage" was set to no
~ making the links to k2 a little better
~ running the intro text through the code of the SEF plugin
# the search - hotspots plugin was not properly working on joomla 2.5 and 3.0
+ Added support for Joomla 3.0
~ setting sticky to 0 when importing from sobi - this way one can edit a hotspot without losing the coordinates
# fixed - edit button in hotspots view was not working
# fixed - infowindow is not centered on the screen when we finish the ajax request
+ updating the CB plugin and adding it to the main package
+ sobiPRO import - added support for the GeoMap field
# fixed - import from sobiPRO was not working
~ making the router function a little more clever. We try to match the hotspot category against the start category selected in the menu
# fixed - map was not working on IE8
# fixed - when editing a hotspot from the frontend the wrong category was selected
# publish/unpublish hotspots redirects to the wrong view
# zoom not working in single view
~ don't rely on $ - avoids conflicts with incorrectly included jquery libraries
# fixed - readmore in menu firing wrong click event
# fixed - search results not showing custom markers
~ search now has pagination and respects the list lenght limit set in the options
# fixed - infoWindow closes when moving around. Now it only closes when one changes the category
# fixed - js bug preventing the map in single view to show the location of the hotspot
# fixed - wrong redirects when entering a hotspot
# fixed - the geolocate button was not click-able in frontend submit form
# fixed - js error when loading the map with custom tiles
# fixed - wrong markers shown when a tab is closed
# fixed - when copying a search link and opening it in another tab the map now loads properly
+ updating the stats module to show number of tiles + option to delete the tiles
# the hotspot name was shown in the div for the marker_address...
~ removing \t \n \r from the ajax response - should reduce the file size a little
# fixed - comma is missing between address and town (infowindow)
# fixed -> wrong tiles generated when searching for something
# updated the liveupdate library - this fixes a bug with wrong version number displayed (no version number displayed)
~ moving to downloadid instead of username&password for live update
- removed the information view as we use overview module in the dashboard for this
# fixed - miltiple KMLs were not shown in the same category
+ added marker length parameter in the settings - controls how many markers are shown at once on the map
+ added custom tiles support
# fixed - hardcoded language strings "There are X hotspots in your current view"
# fixed - unable to save KML files
+ sticky marker option is saves as param - this way when one edits a hotspot and sticky is set to no - we won't replace address or lat & lng values
# search was not properly clearing the results in the menu
# description of categories was not visible in fullscreen
~ continue to look for hotspots when we move around even if the infowindow is open
+ added - option to hide the categories
# fixed - hiding menu hides categories as well
# fixed - menu is now showing uploaded image
# fixed - menu is now respecting the selected settings for country, author, date, address, user_inferface
# fixed - form view was not loading map in IE8
# fixed - some files were missing defined('_JEXEC') ...
# fixed - changing the hotspots.xml file so that it won't install on joomla 1.5 anymore
# fixed - use JString::substr for UTF-8 compatibility when copying images
# fixed - KML view was missing title image
# fixed - not showing edit form when SEF urls were on
# fixed - frontend input hotspots form had invalid html & display issues
# fixed - map not loading under IE8
# fixed - full screen not working under IE9
# an url to the search was not properly executing a search request
# user permission problems when editing in frontend fixed
# discription not shown in single view
# zoom control options were too big when submitting a new hotspot
# language strings updated
+ implemented request: https://compojoom.com/forum/55-wishlist/16432-search-results
~ improved update from 2.0.5
~ fixing hotspot submission bugs
+ added new content plugin that allows you to show a hotspot in an article by using {hotspots hotspot=12} where 12 is the hotspot id
~ when moving around hotspots are displayed way better!
# fixed "close tab" bug
# fixed the zoom bug (thanks Nedyalko)
# fixed layout issue in category edit screen (thanks for the report to Ed)
~ improvements on the submit marker js
# fix for the sticky marker bug (thanks for the report to Ed)
# creating link to a single hotspot had a wrong modal window for selection (thanks for the report to Ed)
# Could not delete categories and hotspots in the backend (thanks for the report to Johnny)
# fixed a bug in the rss module in the backend
# the update db script was not adding index keys for gmlat and gmlng
# the package was containing unnecessary images...
~ adding css for the next and previous buttons
# fixed a bug in the "show all tabs" option
~ layout improvements
+ clicking on marker in streetview will open the infowindow in the streetview mode
~ performance improvements to the JS hotspots Module
~ finding out the category of the article + using ContentHelperRoute to create the link to the hotspots (com_content)
~ using K2HelperRoute class for K2 links
# fixed typo that caused the links to 3rd party components to not be created
# fixed bug with tabs in single view
# fixed the search... (it seems that it was broken in beta1...)
+ added support for publish_up and down in frontend
# add marker view was not fully translatable
~ adding back picture upload for markers
# custom marker image was not used in frontend
# fixed issue with searching and pagination in the backend
# some custom marker fields were not loaded
# backend hotspots was not loading on some linux servers
~ updated some languages
+ added turkish language - thanks for the translation!
+ added a loader module to show loading progress
+ added option to start without a category - centered on the directions
+ added new dashboard in backend
~ improvement to the frontend
+ added send mail plugin for hotspot
~ now it is possible to update from 2.0 to this version
+ frotnend now respects joomla's ACL for adding hotspots
# fixed bug in the RSS feed
~ further refactored js -it is starting to look really good!!!
+ added send js module
+ added print js moduule
# fixed date bug on 2.5
# unable to open hotspot
# saving settings was redirecting to wrong view
~ refactored javascript (using namespace compojoom.hotspots from now on)
+ added turkish frontend translation
# fixed notices
~ removed unnecessary queries
~ removed legacy code
~ speed improvements category layout
# some parts of the interface were nto translated
~ speed improvements to the Hotspots layout in the backend (large DBs - 100 000+ hotspots)
+ added basic ACL support in the backend
# fixed clicking on KML's title didn't bring the edit screen
# fixed wrong links in menu (components dropdown)
+ added sobiPro import
# fixed bug in link_to display in backend
+ added plugin system enabling us to link to 3rd party components
+ installer now installs all plugins
# corrected some js errors
# removed notices
# create a link to single hotspots not working
+ added Italian translation
+ added ukrainian translation
# fixed a problem creating a KML entry in the backend
+ KML files are now shown on map (make sure that you are not accessing the site through localhost!)
# couldn't create hotspots trough the Backend again - due to missing sql fields in the sql file
# couldn't create hotspots trough the Backend
+ we can now choose as many start/default categories as we want
+ added KML views in the backend
~ changed backend edit screen
+ added custom marker image
+ added server side Boundary method
+ new javascript engine relying on "modules"

=====================================================================
LEGEND
=====================================================================
! Note
+ New feature or addition
^ Major change
~ Small change
$ Language change
* Security fix
# Bug fix
- Feature removal