<?php
/**
 * Genrolla Child Theme
 *
 * Loads all parent theme functionality, then lets you add
 * your own tweaks below. Changes here survive parent updates.
 *
 * @package Genrolla_Child
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* Include parent theme functions so all features keep working */
require get_template_directory() . '/functions.php';

/* Load parent + child stylesheets in the right order */
function genrolla_child_enqueue_styles() {
    // Drop the parent's default style handle (it would point to this child stylesheet)
    wp_dequeue_style( 'genrolla-style' );

    // Parent stylesheet first
    wp_enqueue_style(
        'genrolla-parent-style',
        get_template_directory_uri() . '/style.css',
        array( 'genrolla-fonts', 'font-awesome' ),
        '2.1.2'
    );

    // Child stylesheet on top (your overrides)
    wp_enqueue_style(
        'genrolla-child-style',
        get_stylesheet_uri(),
        array( 'genrolla-parent-style' ),
        '1.0.0'
    );
}
add_action( 'wp_enqueue_scripts', 'genrolla_child_enqueue_styles', 20 );

/* RTL support for the child theme */
function genrolla_child_rtl_styles() {
    if ( is_rtl() ) {
        wp_enqueue_style(
            'genrolla-child-rtl',
            get_template_directory_uri() . '/rtl.css',
            array( 'genrolla-child-style' ),
            '1.0.0'
        );
    }
}
add_action( 'wp_enqueue_scripts', 'genrolla_child_rtl_styles', 30 );

/* ============================================================
   YOUR CUSTOM CODE STARTS HERE
   ============================================================ */

/* Example snippet — hide the announcement bar:
add_filter( 'body_class', function( $classes ) {
    $classes[] = 'no-announce';
    return $classes;
} );
*/
