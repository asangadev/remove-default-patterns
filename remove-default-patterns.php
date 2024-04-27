<?php
/*
Plugin Name: Remove Default Patterns
Description: Removes core patterns, remote patterns, and theme patterns from WordPress.
Version: 1.0.0
Author: MOO Digital
*/

// Remove all Core Patterns
add_action( 'after_setup_theme', 'remove_default_patterns_remove_core_patterns' );
function remove_default_patterns_remove_core_patterns() {
    remove_theme_support( 'core-block-patterns' );
}

// Remove all Remote Patterns
add_filter( 'should_load_remote_block_patterns', '__return_false' );

// Remove all Theme Patterns
function remove_default_patterns_unregister_patterns() {
    $registered_patterns = WP_Block_Patterns_Registry::get_instance()->get_all_registered();
    
    foreach ( $registered_patterns as $pattern_name => $pattern ) {
        unregister_block_pattern( $pattern_name );
    }
}
add_action( 'init', 'remove_default_patterns_unregister_patterns', 999 );
