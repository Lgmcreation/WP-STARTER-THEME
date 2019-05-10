<?php
if ( !defined('ABSPATH') ) die();

define('DEV_MODE', true);

/**
* Theme includes
*/
require_once locate_template('/lib/init.php');  // Setup I18n add_theme_support TinyMce Gallery
require_once locate_template('/lib/gutenberg.php');         // Menu Dashboard Client
require_once locate_template('/lib/security.php');         // Security
require_once locate_template('/lib/clean.php');         // Clean Head Bodyclass ponctuation 
require_once locate_template('/lib/nav.php');        // Nav 
require_once locate_template('/lib/blog.php');      // Blog 
require_once locate_template('/lib/script.php');         // Scripts and stylesheets
require_once locate_template('/lib/admin.php');         // Dashboard
require_once locate_template('/lib/client.php');         // Menu Dashboard Client
/**
* Plugin includes
*/
require_once locate_template('/lib/yoast.php');         // YOAST
require_once locate_template('/lib/acf.php');         // ACF What else
