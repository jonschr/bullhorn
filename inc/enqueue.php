<?php

add_action( 'wp_enqueue_scripts', 'na_enqueue' );
function na_enqueue() {
	
	// Plugin styles
    wp_enqueue_style( 'neighborhood-attractions-style', BULLHORN_URL . 'assets/css/neighborhood-attractions.css', array(), BULLHORN_VERSION, 'screen' );
    
    // Script
    wp_register_script( 'neighborhood-attractions-filter-ajax', BULLHORN_URL . 'assets/js/neighborhood-attractions-filter-ajax.js', array( 'jquery' ), BULLHORN_VERSION, true );
    wp_register_script( 'neighborhood-attractions-map', BULLHORN_URL . 'assets/js/neighborhood-attractions-map.js', array( 'jquery' ), BULLHORN_VERSION, true );
    
}

function enqueue_custom_editor_assets() {
    
    $screen = get_current_screen();
    
    // // bail if we're not on the promotions post type
    // if ( !$screen || $screen->post_type !== 'promotions' )
    //     return;
    
    // Enqueue JavaScript
    wp_enqueue_script(
        'custom-editor-script',
        BULLHORN_URL . 'assets/js/custom-editor-scripts.js',
        array( 'wp-blocks', 'wp-dom' ),
        BULLHORN_VERSION,
        true
    );

    // Enqueue CSS
    wp_enqueue_style(
        'custom-editor-style',
        BULLHORN_URL . 'assets/css/custom-editor-style.css',
        array( 'wp-edit-blocks' ),
        BULLHORN_VERSION
    );
}
add_action( 'enqueue_block_editor_assets', 'enqueue_custom_editor_assets' );

