<?php

add_action( 'wp_enqueue_scripts', 'na_enqueue' );
function na_enqueue() {
	
	// Plugin styles
    wp_enqueue_style( 'neighborhood-attractions-style', BULLHORN_DIR . 'assets/css/neighborhood-attractions.css', array(), BULLHORN_VERSION, 'screen' );
    
    // Script
    wp_register_script( 'neighborhood-attractions-filter-ajax', BULLHORN_DIR . 'assets/js/neighborhood-attractions-filter-ajax.js', array( 'jquery' ), BULLHORN_VERSION, true );
    wp_register_script( 'neighborhood-attractions-map', BULLHORN_DIR . 'assets/js/neighborhood-attractions-map.js', array( 'jquery' ), BULLHORN_VERSION, true );
    
}