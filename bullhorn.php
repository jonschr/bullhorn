<?php
/*
	Plugin Name: Bullhorn
	Plugin URI: https://github.com/jonschr/bullhorn
    Description: Just another highlight plugin
	Version: 0.2.1
    Author: Jon Schroeder
    Author URI: https://elod.in

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.
    
*/

/* Prevent direct access to the plugin */
if ( !defined( 'ABSPATH' ) ) {
    die( "Sorry, you are not allowed to access this page directly." );
}

// Define the version of the plugin
define( 'BULLHORN_VERSION', '0.2.1' );

// Plugin directory
define( 'BULLHORN_URL', plugin_dir_url( __FILE__ ) );
define( 'BULLHORN_DIR', dirname( __FILE__ ) );

$directory = new RecursiveDirectoryIterator(BULLHORN_DIR . "/inc/");
$iterator = new RecursiveIteratorIterator($directory);
$phpFiles = new RegexIterator($iterator, '/\.php$/');

foreach ($phpFiles as $phpFile) {
    require_once $phpFile->getPathname();
}

//* Used for debugging
if ( !function_exists( 'console_log' ) ) {
	function console_log( $data ){
		echo '<script>';
		echo 'console.log('. json_encode( $data ) .')';
		echo '</script>';
	}
}

//* Plugin Update Checker
require 'vendor/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/jonschr/bullhorn',
	__FILE__,
	'bullhorn'
);

// Optional: Set the branch that contains the stable release.
$myUpdateChecker->setBranch('main');
