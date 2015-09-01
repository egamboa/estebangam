<?php
/** بسم الله الرحمن الرحيم **

Plugin Name: Aqua Page Builder
Plugin URI: http://aquagraphite.com/page-builder
Description: Easily create custom page templates with intuitive drag-and-drop interface. Requires PHP5 and WP3.5
Version: 1.1.2
Author: Syamil MJ
Author URI: http://aquagraphite.com

*/
 
/**
 * Copyright (c) 2013 Syamil MJ. All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * **********************************************************************
 */

//definitions
if(!defined('AQPB_VERSION')) define( 'AQPB_VERSION', '1.1.2' );
if(!defined('AQPB_PATH')) define( 'AQPB_PATH', plugin_dir_path(__FILE__) );
if(!defined('AQPB_DIR')) define( 'AQPB_DIR', plugin_dir_url(__FILE__) );

//required functions & classes
require_once(AQPB_PATH . 'functions/aqpb_config.php');
require_once(AQPB_PATH . 'functions/aqpb_blocks.php');
require_once(AQPB_PATH . 'classes/class-aq-page-builder.php');
require_once(AQPB_PATH . 'classes/class-aq-block.php');
//require_once(AQPB_PATH . 'classes/class-aq-plugin-updater.php');
require_once(AQPB_PATH . 'functions/aqpb_functions.php');

//BFI Thumb Crop Imgage
require_once(AQPB_PATH . 'functions/BFI_Thumb.php');

//some default blocks
require_once(AQPB_PATH . 'blocks/st-container-open-block.php');
require_once(AQPB_PATH . 'blocks/st-container-close-block.php');
require_once(AQPB_PATH . 'blocks/st-section-block.php');
require_once(AQPB_PATH . 'blocks/st-cta-block.php');
require_once(AQPB_PATH . 'blocks/st-about-block.php');
require_once(AQPB_PATH . 'blocks/st-resume-block.php');
require_once(AQPB_PATH . 'blocks/st-skills-block.php');
require_once(AQPB_PATH . 'blocks/st-personal-skills-block.php');
require_once(AQPB_PATH . 'blocks/st-portfolio-block.php');
require_once(AQPB_PATH . 'blocks/st-post-block.php');
require_once(AQPB_PATH . 'blocks/st-contact-block.php');
require_once(AQPB_PATH . 'blocks/st-download-block.php');


//register default blocks
aq_register_block('ST_Container_Open_Block');
aq_register_block('ST_Container_Close_Block');
aq_register_block('ST_Section_Block');
aq_register_block('ST_CTA_Block');
aq_register_block('ST_About_Block');
aq_register_block('ST_Resume_Block');
aq_register_block('ST_Skills_Block');
aq_register_block('ST_Personal_Block');
aq_register_block('ST_Portfolio_Block');
aq_register_block('ST_Post_Block');
aq_register_block('ST_Contact_Block');
aq_register_block('ST_Download_Block');



//fire up page builder
$aqpb_config = aq_page_builder_config();
$aq_page_builder = new AQ_Page_Builder($aqpb_config);
if(!is_network_admin()) $aq_page_builder->init();
