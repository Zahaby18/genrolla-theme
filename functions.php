<?php
/**
 * Genrolla Theme Functions
 * 
 * @package Genrolla
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Theme Setup
 */
function genrolla_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 800, 450, true );

    // Register navigation menus
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'genrolla' ),
        'footer'  => esc_html__( 'Footer Menu', 'genrolla' ),
    ) );

    // Switch default core markup to output valid HTML5
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // Add theme support for selective refresh for widgets
    add_theme_support( 'customize-selective-refresh-widgets' );

    // Add support for custom logo
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // Add support for editor styles
    add_theme_support( 'editor-styles' );
}
add_action( 'after_setup_theme', 'genrolla_setup' );

/**
 * Set content width
 */
function genrolla_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'genrolla_content_width', 800 );
}
add_action( 'after_setup_theme', 'genrolla_content_width', 0 );

/**
 * Register Widget Areas
 */
function genrolla_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'genrolla' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'genrolla' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget Area 1', 'genrolla' ),
        'id'            => 'footer-1',
        'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'genrolla' ),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget Area 2', 'genrolla' ),
        'id'            => 'footer-2',
        'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'genrolla' ),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget Area 3', 'genrolla' ),
        'id'            => 'footer-3',
        'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'genrolla' ),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'genrolla_widgets_init' );

/**
 * Enqueue Scripts and Styles
 */
function genrolla_scripts() {
    // Main stylesheet
    wp_enqueue_style( 'genrolla-style', get_stylesheet_uri(), array(), '1.0.0' );

    // Comment reply script
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'genrolla_scripts' );

/**
 * Customizer Options
 */
function genrolla_customize_register( $wp_customize ) {
    // Primary Color
    $wp_customize->add_setting( 'genrolla_primary_color', array(
        'default'           => '#0066cc',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'genrolla_primary_color', array(
        'label'    => esc_html__( 'Primary Color', 'genrolla' ),
        'section'  => 'colors',
        'settings' => 'genrolla_primary_color',
    ) ) );

    // Layout Options
    $wp_customize->add_section( 'genrolla_layout', array(
        'title'    => esc_html__( 'Layout Options', 'genrolla' ),
        'priority' => 30,
    ) );

    $wp_customize->add_setting( 'genrolla_sidebar_position', array(
        'default'           => 'right',
        'sanitize_callback' => 'genrolla_sanitize_sidebar_position',
    ) );

    $wp_customize->add_control( 'genrolla_sidebar_position', array(
        'label'    => esc_html__( 'Sidebar Position', 'genrolla' ),
        'section'  => 'genrolla_layout',
        'type'     => 'select',
        'choices'  => array(
            'left'  => esc_html__( 'Left', 'genrolla' ),
            'right' => esc_html__( 'Right', 'genrolla' ),
            'none'  => esc_html__( 'No Sidebar', 'genrolla' ),
        ),
    ) );

    // Newsletter Section
    $wp_customize->add_section( 'genrolla_newsletter', array(
        'title'    => esc_html__( 'Newsletter Settings', 'genrolla' ),
        'priority' => 35,
    ) );

    $wp_customize->add_setting( 'genrolla_newsletter_title', array(
        'default'           => esc_html__( 'Subscribe to Our Newsletter', 'genrolla' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'genrolla_newsletter_title', array(
        'label'    => esc_html__( 'Newsletter Title', 'genrolla' ),
        'section'  => 'genrolla_newsletter',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'genrolla_newsletter_text', array(
        'default'           => esc_html__( 'Get the latest posts delivered right to your inbox.', 'genrolla' ),
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );

    $wp_customize->add_control( 'genrolla_newsletter_text', array(
        'label'    => esc_html__( 'Newsletter Description', 'genrolla' ),
        'section'  => 'genrolla_newsletter',
        'type'     => 'textarea',
    ) );

    $wp_customize->add_setting( 'genrolla_newsletter_show_home', array(
        'default'           => true,
        'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( 'genrolla_newsletter_show_home', array(
        'label'    => esc_html__( 'Show Newsletter Box on Homepage', 'genrolla' ),
        'section'  => 'genrolla_newsletter',
        'type'     => 'checkbox',
    ) );

    $wp_customize->add_setting( 'genrolla_newsletter_show_single', array(
        'default'           => true,
        'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( 'genrolla_newsletter_show_single', array(
        'label'    => esc_html__( 'Show Newsletter Box in Single Posts', 'genrolla' ),
        'section'  => 'genrolla_newsletter',
        'type'     => 'checkbox',
    ) );
}
add_action( 'customize_register', 'genrolla_customize_register' );

/**
 * Sanitize sidebar position
 */
function genrolla_sanitize_sidebar_position( $input ) {
    $valid = array( 'left', 'right', 'none' );
    return in_array( $input, $valid ) ? $input : 'right';
}

/**
 * Custom Excerpt Length
 */
function genrolla_excerpt_length( $length ) {
    return 25;
}
add_filter( 'excerpt_length', 'genrolla_excerpt_length' );

/**
 * Custom Excerpt More
 */
function genrolla_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'genrolla_excerpt_more' );

/**
 * Get Related Posts
 */
function genrolla_get_related_posts( $post_id, $number = 3 ) {
    $categories = wp_get_post_categories( $post_id );
    
    if ( empty( $categories ) ) {
        return array();
    }

    $args = array(
        'category__in'   => $categories,
        'post__not_in'   => array( $post_id ),
        'posts_per_page' => $number,
        'orderby'        => 'rand',
    );

    return get_posts( $args );
}

/**
 * Display Breadcrumbs
 */
function genrolla_breadcrumbs() {
    if ( is_front_page() ) {
        return;
    }

    echo '<nav class="breadcrumbs" aria-label="Breadcrumb">';
    echo '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'genrolla' ) . '</a>';
    echo ' <span class="separator">/</span> ';

    if ( is_category() ) {
        single_cat_title();
    } elseif ( is_single() ) {
        $categories = get_the_category();
        if ( ! empty( $categories ) ) {
            echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
            echo ' <span class="separator">/</span> ';
        }
        the_title();
    } elseif ( is_page() ) {
        the_title();
    } elseif ( is_search() ) {
        echo esc_html__( 'Search Results', 'genrolla' );
    } elseif ( is_404() ) {
        echo esc_html__( '404 Not Found', 'genrolla' );
    }

    echo '</nav>';
}

/**
 * Add Schema.org markup to posts
 */
function genrolla_add_schema_markup() {
    if ( ! is_single() ) {
        return;
    }

    global $post;
    $schema = array(
        '@context'      => 'https://schema.org',
        '@type'         => 'Article',
        'headline'      => get_the_title(),
        'datePublished' => get_the_date( 'c' ),
        'dateModified'  => get_the_modified_date( 'c' ),
        'author'        => array(
            '@type' => 'Person',
            'name'  => get_the_author(),
        ),
    );

    if ( has_post_thumbnail() ) {
        $schema['image'] = get_the_post_thumbnail_url( $post, 'full' );
    }

    echo '<script type="application/ld+json">' . wp_json_encode( $schema ) . '</script>';
}
add_action( 'wp_head', 'genrolla_add_schema_markup' );
