<?php
/**
 * Genrolla Child Theme
 *
 * Loads all parent theme functionality, then lets you add
 * your own tweaks below. Changes here survive parent updates.
 *
 * @package Genrolla_Child
 * @version 1.0.2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*
 * Include parent theme functions so all features keep working.
 * Parent functions.php is fully guarded (file-level + per-function),
 * so this can never cause a "Cannot redeclare" fatal error.
 */
require_once get_template_directory() . '/functions.php';

/* Load parent + child stylesheets in the right order */
function genrolla_child_enqueue_styles() {
    $parent_version = wp_get_theme( get_template() )->get( 'Version' );
    $child_version  = wp_get_theme()->get( 'Version' );

    // Drop the parent's default style handle (it would point to this child stylesheet)
    wp_dequeue_style( 'genrolla-style' );

    // Parent stylesheet first
    wp_enqueue_style(
        'genrolla-parent-style',
        get_template_directory_uri() . '/style.css',
        array( 'genrolla-fonts', 'genrolla-fontawesome' ),
        $parent_version
    );

    // Child stylesheet on top (your overrides)
    wp_enqueue_style(
        'genrolla-child-style',
        get_stylesheet_uri(),
        array( 'genrolla-parent-style' ),
        $child_version
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
            wp_get_theme()->get( 'Version' )
        );
    }
}
add_action( 'wp_enqueue_scripts', 'genrolla_child_rtl_styles', 30 );

/* ============================================================
   YOUR CUSTOM CODE STARTS HERE
   ============================================================ */
