<?php
/**
 * Genrolla — Modern Blog Theme
 *
 * @package Genrolla
 * @version 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'GENROLLA_VERSION', '2.1.3' );

/* ============================================================
 * THEME SETUP
 * ============================================================ */
function genrolla_setup() {
    load_theme_textdomain( 'genrolla', get_template_directory() . '/languages' );

    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', array(
        'height'      => 120,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'responsive-embeds' );

    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'genrolla' ),
        'footer'  => esc_html__( 'Footer Menu', 'genrolla' ),
    ) );

    set_post_thumbnail_size( 800, 500, true );
    add_image_size( 'genrolla-card', 600, 375, true );
    add_image_size( 'genrolla-featured', 1100, 620, true );
}
add_action( 'after_setup_theme', 'genrolla_setup' );

function genrolla_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'genrolla_content_width', 800 );
}
add_action( 'after_setup_theme', 'genrolla_content_width', 0 );

/* ============================================================
 * WIDGETS
 * ============================================================ */
function genrolla_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'genrolla' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Appears in single posts & archives.', 'genrolla' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    for ( $i = 1; $i <= 3; $i++ ) {
        register_sidebar( array(
            /* translators: %d: footer column number */
            'name'          => sprintf( esc_html__( 'Footer Column %d', 'genrolla' ), $i ),
            'id'            => "footer-$i",
            'description'   => esc_html__( 'Footer widget area.', 'genrolla' ),
            'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="footer-widget-title">',
            'after_title'   => '</h4>',
        ) );
    }
}
add_action( 'widgets_init', 'genrolla_widgets_init' );

/* ============================================================
 * ENQUEUE
 * ============================================================ */
function genrolla_scripts() {
    // Google Fonts
    wp_enqueue_style( 'genrolla-fonts', 'https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap', array(), null );
    // Font Awesome
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css', array(), '6.5.2' );
    // Theme CSS
    wp_enqueue_style( 'genrolla-style', get_stylesheet_uri(), array( 'genrolla-fonts', 'font-awesome' ), GENROLLA_VERSION );

    // RTL support
    if ( is_rtl() ) {
        wp_enqueue_style( 'genrolla-rtl', get_template_directory_uri() . '/rtl.css', array( 'genrolla-style' ), GENROLLA_VERSION );
    }
    // Theme JS
    wp_enqueue_script( 'genrolla-main', get_template_directory_uri() . '/assets/js/main.js', array(), GENROLLA_VERSION, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'genrolla_scripts' );

/* ============================================================
 * CUSTOMIZER
 * ============================================================ */
function genrolla_customize_register( $wp_customize ) {

    /* --- Colors --- */
    $wp_customize->add_setting( 'genrolla_bg_color', array(
        'default' => '#0F1113', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage',
    ) );
    $wp_customize->add_setting( 'genrolla_accent_color', array(
        'default' => '#A3FF12', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'genrolla_bg_color', array(
        'label' => esc_html__( 'Background Color', 'genrolla' ), 'section' => 'colors', 'settings' => 'genrolla_bg_color',
    ) ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'genrolla_accent_color', array(
        'label' => esc_html__( 'Accent (Neon) Color', 'genrolla' ), 'section' => 'colors', 'settings' => 'genrolla_accent_color',
    ) ) );

    /* --- Hero --- */
    $wp_customize->add_section( 'genrolla_hero', array(
        'title' => esc_html__( 'Hero Section', 'genrolla' ), 'priority' => 30,
    ) );
    $wp_customize->add_setting( 'genrolla_hero_image', array(
        'default' => '', 'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'genrolla_hero_image', array(
        'label' => esc_html__( 'Hero Background Image', 'genrolla' ), 'section' => 'genrolla_hero', 'settings' => 'genrolla_hero_image',
    ) ) );
    $wp_customize->add_setting( 'genrolla_hero_title', array(
        'default' => esc_html__( 'Level up your career, your way.', 'genrolla' ), 'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'genrolla_hero_title', array(
        'label' => esc_html__( 'Hero Title', 'genrolla' ), 'section' => 'genrolla_hero', 'type' => 'textarea',
    ) );
    $wp_customize->add_setting( 'genrolla_hero_subtitle', array(
        'default' => esc_html__( 'Practical guides to help you work smart, not just work hard.', 'genrolla' ),
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'genrolla_hero_subtitle', array(
        'label' => esc_html__( 'Hero Subtitle', 'genrolla' ), 'section' => 'genrolla_hero', 'type' => 'textarea',
    ) );
    $wp_customize->add_setting( 'genrolla_hero_btn_text', array(
        'default' => esc_html__( 'Start reading free', 'genrolla' ), 'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'genrolla_hero_btn_text', array(
        'label' => esc_html__( 'Hero Button Text', 'genrolla' ), 'section' => 'genrolla_hero', 'type' => 'text',
    ) );
    $wp_customize->add_setting( 'genrolla_hero_btn_url', array(
        'default' => '', 'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'genrolla_hero_btn_url', array(
        'label' => esc_html__( 'Hero Button URL (empty = scroll to posts)', 'genrolla' ), 'section' => 'genrolla_hero', 'type' => 'url',
    ) );

    /* --- Newsletter --- */
    $wp_customize->add_section( 'genrolla_newsletter', array(
        'title' => esc_html__( 'Newsletter Settings', 'genrolla' ), 'priority' => 35,
    ) );
    $wp_customize->add_setting( 'genrolla_newsletter_title', array(
        'default' => esc_html__( 'Don\'t miss weekly career insights.', 'genrolla' ), 'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'genrolla_newsletter_title', array(
        'label' => esc_html__( 'Newsletter Title', 'genrolla' ), 'section' => 'genrolla_newsletter', 'type' => 'text',
    ) );
    $wp_customize->add_setting( 'genrolla_newsletter_text', array(
        'default' => esc_html__( 'Join 30,000+ readers getting career & finance tips straight to their inbox. Free.', 'genrolla' ),
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'genrolla_newsletter_text', array(
        'label' => esc_html__( 'Newsletter Description', 'genrolla' ), 'section' => 'genrolla_newsletter', 'type' => 'textarea',
    ) );
    $wp_customize->add_setting( 'genrolla_newsletter_form_action', array(
        'default' => '', 'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'genrolla_newsletter_form_action', array(
        'label' => esc_html__( 'Form action URL (optional — overrides built-in storage; use MC4WP/ConvertKit endpoint)', 'genrolla' ),
        'section' => 'genrolla_newsletter', 'type' => 'url',
    ) );
    $wp_customize->add_setting( 'genrolla_newsletter_shortcode', array(
        'default' => '', 'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'genrolla_newsletter_shortcode', array(
        'label' => esc_html__( 'Newsletter Plugin Shortcode (e.g. [mc4wp_form id="1"])', 'genrolla' ),
        'section' => 'genrolla_newsletter', 'type' => 'text',
    ) );

    /* --- Footer --- */
    $wp_customize->add_setting( 'genrolla_copyright', array(
        'default' => esc_html__( 'All rights reserved.', 'genrolla' ), 'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'genrolla_copyright', array(
        'label' => esc_html__( 'Footer Copyright Text', 'genrolla' ), 'section' => 'title_tagline', 'type' => 'text',
    ) );
    $wp_customize->add_setting( 'genrolla_footer_credit', array(
        'default' => '', 'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'genrolla_footer_credit', array(
        'label' => esc_html__( 'Footer Credit Text (optional — e.g. "Made with ♥ by Your Brand")', 'genrolla' ), 'section' => 'title_tagline', 'type' => 'text',
    ) );
    /* --- Advanced: Head & Body Code (Google Tag / GTM / Analytics) --- */
    $wp_customize->add_section( 'genrolla_advanced', array(
        'title' => esc_html__( 'Advanced Code (Analytics)', 'genrolla' ), 'priority' => 40,
    ) );
    $wp_customize->add_setting( 'genrolla_head_code', array(
        'default' => '', 'sanitize_callback' => 'genrolla_sanitize_code',
    ) );
    $wp_customize->add_control( 'genrolla_head_code', array(
        'label' => esc_html__( 'Head Code', 'genrolla' ),
        'description' => esc_html__( 'Paste Google Tag / GTM / Analytics snippet here. Output before </head>.', 'genrolla' ),
        'section' => 'genrolla_advanced', 'type' => 'textarea',
    ) );
    $wp_customize->add_setting( 'genrolla_body_code', array(
        'default' => '', 'sanitize_callback' => 'genrolla_sanitize_code',
    ) );
    $wp_customize->add_control( 'genrolla_body_code', array(
        'label' => esc_html__( 'Body Code', 'genrolla' ),
        'description' => esc_html__( 'GTM noscript/body snippet. Output right after <body>.', 'genrolla' ),
        'section' => 'genrolla_advanced', 'type' => 'textarea',
    ) );
}
add_action( 'customize_register', 'genrolla_customize_register' );

/* Sanitize tracking code: allow script/iframe/link/meta, strip event handlers & javascript: */
function genrolla_sanitize_code( $input ) {
    $allowed = array(
        'script'   => array( 'async' => true, 'defer' => true, 'src' => true, 'type' => true, 'id' => true, 'crossorigin' => true, 'integrity' => true ),
        'noscript' => array(),
        'iframe'   => array( 'src' => true, 'width' => true, 'height' => true, 'style' => true, 'frameborder' => true, 'allowfullscreen' => true, 'allow' => true ),
        'link'     => array( 'rel' => true, 'href' => true, 'as' => true, 'type' => true, 'crossorigin' => true, 'media' => true, 'hreflang' => true ),
        'meta'     => array( 'name' => true, 'content' => true, 'http-equiv' => true ),
    );
    return wp_kses( $input, $allowed );
}

/* Output head/body codes */
function genrolla_output_analytics_codes() {
    $head = get_theme_mod( 'genrolla_head_code', '' );
    if ( $head ) {
        echo "\n<!-- Genrolla head code -->\n" . $head . "\n";
    }
}
add_action( 'genrolla_head_top', 'genrolla_output_analytics_codes', 1 );

function genrolla_output_analytics_body_code() {
    $body = get_theme_mod( 'genrolla_body_code', '' );
    if ( $body ) {
        echo "\n<!-- Genrolla body code -->\n" . $body . "\n";
    }
}
add_action( 'genrolla_body_top', 'genrolla_output_analytics_body_code', 1 );

function genrolla_customize_css() {
    $bg      = get_theme_mod( 'genrolla_bg_color', '#0F1113' );
    $accent  = get_theme_mod( 'genrolla_accent_color', '#A3FF12' );
    ?>
    <style id="genrolla-colors">
        :root{--bg:<?php echo esc_attr( $bg ); ?>;--neon:<?php echo esc_attr( $accent ); ?>}
    </style>
    <?php
}
add_action( 'wp_head', 'genrolla_customize_css', 20 );

/* ============================================================
 * SEO HELPERS
 * ============================================================ */

/* Article schema (JSON-LD) on single posts */
function genrolla_schema_article() {
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
            'url'   => get_author_posts_url( get_the_author_meta( 'ID' ) ),
        ),
        'publisher'     => array(
            '@type' => 'Organization',
            'name'  => get_bloginfo( 'name' ),
        ),
        'mainEntityOfPage' => get_permalink(),
    );
    if ( has_post_thumbnail() ) {
        $schema['image'] = get_the_post_thumbnail_url( $post, 'full' );
    }
    echo '<script type="application/ld+json">' . wp_json_encode( $schema ) . '</script>' . "\n";
}
add_action( 'wp_head', 'genrolla_schema_article' );

/* BreadcrumbList schema */
function genrolla_schema_breadcrumb( $items ) {
    $schema = array(
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => array(),
    );
    $i = 1;
    foreach ( $items as $label => $url ) {
        $schema['itemListElement'][] = array(
            '@type'    => 'ListItem',
            'position' => $i,
            'name'     => $label,
            'item'     => $url,
        );
        $i++;
    }
    echo '<script type="application/ld+json">' . wp_json_encode( $schema ) . '</script>' . "\n";
}

/* ============================================================
 * BREADCRUMB
 * ============================================================ */
function genrolla_breadcrumb() {
    if ( is_front_page() ) {
        return;
    }
    $items = array( __( 'Home', 'genrolla' ) => home_url( '/' ) );

    // If there is a dedicated Blog (posts) page, use it as hub for post archives
    $posts_page_id    = get_option( 'page_for_posts' );
    $posts_page_url   = $posts_page_id ? get_permalink( $posts_page_id ) : '';
    $posts_page_label = $posts_page_id ? get_the_title( $posts_page_id ) : __( 'Blog', 'genrolla' );

    if ( is_category() ) {
        // Blog hub (if exists)
        if ( $posts_page_url ) {
            $items[ $posts_page_label ] = $posts_page_url;
        }
        // Parent category chain (Home > Blog > Parent > Child)
        $cat       = get_queried_object();
        $parents   = array();
        $parent_id = (int) $cat->category_parent;
        while ( $parent_id ) {
            $parent = get_category( $parent_id );
            if ( ! $parent || is_wp_error( $parent ) ) {
                break;
            }
            $parents[] = $parent;
            $parent_id = (int) $parent->category_parent;
        }
        foreach ( array_reverse( $parents ) as $parent ) {
            $items[ $parent->name ] = get_category_link( $parent->term_id );
        }
        $items[ single_cat_title( '', false ) ] = get_category_link( $cat );
    } elseif ( is_tag() ) {
        if ( $posts_page_url ) {
            $items[ $posts_page_label ] = $posts_page_url;
        }
        $tag = get_queried_object();
        $items[ single_tag_title( '', false ) ] = get_tag_link( $tag );
    } elseif ( is_author() ) {
        if ( $posts_page_url ) {
            $items[ $posts_page_label ] = $posts_page_url;
        }
        $author = get_queried_object();
        $items[ get_the_author_meta( 'display_name', $author->ID ) ] = get_author_posts_url( $author->ID );
    } elseif ( is_date() ) {
        if ( $posts_page_url ) {
            $items[ $posts_page_label ] = $posts_page_url;
        }
        $items[ get_the_date( 'F Y' ) ] = '';
    } elseif ( is_single() ) {
        $cats = get_the_category();
        if ( ! empty( $cats ) ) {
            $items[ $cats[0]->name ] = get_category_link( $cats[0]->term_id );
        }
        $items[ get_the_title() ] = get_permalink();
    } elseif ( is_page() ) {
        $items[ get_the_title() ] = get_permalink();
    } elseif ( is_search() ) {
        $items[ __( 'Search results', 'genrolla' ) ] = get_search_link( get_search_query() );
    } elseif ( is_404() ) {
        $items[ __( 'Page not found', 'genrolla' ) ] = '';
    } elseif ( is_home() ) {
        $items[ __( 'Blog', 'genrolla' ) ] = get_permalink( get_option( 'page_for_posts' ) );
    }

    // Render visual breadcrumb
    echo '<nav class="breadcrumb" aria-label="Breadcrumb">';
    $count = count( $items );
    $i     = 1;
    foreach ( $items as $label => $url ) {
        if ( $i === $count || empty( $url ) ) {
            echo '<span>' . esc_html( $label ) . '</span>';
        } else {
            echo '<a href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a>';
            echo '<span class="sep"><i class="fa-solid fa-chevron-right"></i></span>';
        }
        $i++;
    }
    echo '</nav>';

    // JSON-LD
    genrolla_schema_breadcrumb( $items );
}

/* ============================================================
 * MISC HELPERS
 * ============================================================ */

/* Trending posts: most commented first, fallback to "Highlight" category, then latest */
function genrolla_get_trending( $count = 3 ) {
    $args = array(
        'posts_per_page'      => $count,
        'orderby'             => 'comment_count',
        'order'               => 'DESC',
        'ignore_sticky_posts' => true,
        'no_found_rows'       => true,
    );
    $q = new WP_Query( $args );
    $posts = $q->posts;

    // Check if any returned post actually has comments
    $has_comments = false;
    foreach ( $posts as $p ) {
        if ( ! empty( $p->comment_count ) && (int) $p->comment_count > 0 ) {
            $has_comments = true;
            break;
        }
    }

    if ( ! $has_comments ) {
        // Fallback 1: posts from "Highlight" category (slug: highlight)
        $term = get_term_by( 'slug', 'highlight', 'category' );
        if ( $term ) {
            $hl = new WP_Query( array(
                'posts_per_page'      => $count,
                'cat'                 => (int) $term->term_id,
                'ignore_sticky_posts' => true,
                'no_found_rows'       => true,
            ) );
            if ( $hl->have_posts() ) {
                return $hl->posts;
            }
        }
        // Fallback 2: latest posts
        return get_posts( array( 'posts_per_page' => $count, 'ignore_sticky_posts' => true ) );
    }

    return $posts;
}

/* Read time */
function genrolla_read_time( $post_id = null ) {
    $content = get_post_field( 'post_content', $post_id ? $post_id : get_the_ID() );
    $words   = str_word_count( wp_strip_all_tags( $content ) );
    $minutes = max( 1, ceil( $words / 200 ) );
    /* translators: %d: minutes */
    return sprintf( _n( '%d min read', '%d min read', $minutes, 'genrolla' ), $minutes );
}

/* Category badge (first category of post) */
function genrolla_first_category( $post_id = null ) {
    $cats = get_the_category( $post_id ? $post_id : get_the_ID() );
    if ( empty( $cats ) ) {
        return '';
    }
    return '<a href="' . esc_url( get_category_link( $cats[0]->term_id ) ) . '" class="cat">' . esc_html( $cats[0]->name ) . '</a>';
}

/* Card fallback class when no thumbnail */
function genrolla_card_fallback_class( $post_id = null ) {
    if ( has_post_thumbnail( $post_id ? $post_id : get_the_ID() ) ) {
        return '';
    }
    return ' no-thumb';
}

/* Post excerpt fallback */
function genrolla_excerpt( $post_id = null, $length = 22 ) {
    $post_id = $post_id ? $post_id : get_the_ID();
    $excerpt = get_the_excerpt( $post_id );
    if ( ! $excerpt ) {
        $excerpt = wp_strip_all_tags( get_post_field( 'post_content', $post_id ) );
    }
    $words = explode( ' ', $excerpt );
    if ( count( $words ) > $length ) {
        $excerpt = implode( ' ', array_slice( $words, 0, $length ) ) . '...';
    }
    return $excerpt;
}

/* Related posts by shared category */
function genrolla_related_posts( $count = 3 ) {
    $cats = wp_get_post_categories( get_the_ID() );
    if ( empty( $cats ) ) {
        return array();
    }
    $args = array(
        'category__in'   => $cats,
        'post__not_in'   => array( get_the_ID() ),
        'posts_per_page' => $count,
        'orderby'        => 'rand',
        'no_found_rows'  => true,
    );
    return get_posts( $args );
}

/* Author box template part loader */
function genrolla_author_box() {
    get_template_part( 'template-parts/author-box' );
}

/* ============================================================
 * SUBSCRIBERS — built-in newsletter storage (CPT + Export CSV)
 * ============================================================ */

/* Register CPT "subscriber" automatically on theme activation */
function genrolla_register_subscriber_cpt() {
    register_post_type( 'subscriber', array(
        'labels'       => array(
            'name'          => esc_html__( 'Subscribers', 'genrolla' ),
            'singular_name' => esc_html__( 'Subscriber', 'genrolla' ),
            'edit_item'     => esc_html__( 'View Subscriber', 'genrolla' ),
            'search_items'  => esc_html__( 'Search Subscribers', 'genrolla' ),
            'not_found'     => esc_html__( 'No subscribers yet. Use the newsletter form on your site.', 'genrolla' ),
        ),
        'public'       => false,
        'show_ui'      => true,
        'show_in_menu' => true,
        'menu_icon'    => 'dashicons-email-alt',
        'supports'     => array( 'title' ),
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'rewrite'      => false,
    ) );
}
add_action( 'init', 'genrolla_register_subscriber_cpt' );

/* Handle newsletter form submission -> store email in CPT */
function genrolla_handle_subscribe() {
    if ( ! isset( $_POST['genrolla_subscribe'] ) ) {
        return;
    }

    // Honeypot: bots fill hidden field
    if ( ! empty( $_POST['genrolla_hp'] ) ) {
        wp_safe_redirect( add_query_arg( 'subscribe_error', 'bot', wp_get_referer() ? wp_get_referer() : home_url( '/' ) ) );
        exit;
    }

    $email = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
    if ( ! is_email( $email ) ) {
        wp_safe_redirect( add_query_arg( 'subscribe_error', 'invalid', wp_get_referer() ? wp_get_referer() : home_url( '/' ) ) );
        exit;
    }

    // Duplicate check by email (stored as post title)
    $existing = get_posts( array(
        'post_type'   => 'subscriber',
        'post_status' => 'any',
        'title'       => $email,
        'numberposts' => 1,
    ) );

    if ( empty( $existing ) ) {
        wp_insert_post( array(
            'post_type'   => 'subscriber',
            'post_title'  => $email,
            'post_status' => 'publish',
        ) );
    } else {
        wp_safe_redirect( add_query_arg( 'subscribe_error', 'duplicate', wp_get_referer() ? wp_get_referer() : home_url( '/' ) ) );
        exit;
    }

    wp_safe_redirect( add_query_arg( 'subscribed', '1', wp_get_referer() ? wp_get_referer() : home_url( '/' ) ) );
    exit;
}
add_action( 'template_redirect', 'genrolla_handle_subscribe' );

/* Export CSV button on the Subscribers list page */
function genrolla_subscriber_views( $views ) {
    if ( current_user_can( 'manage_options' ) ) {
        $url = wp_nonce_url( admin_url( 'edit.php?post_type=subscriber&genrolla_export=1' ), 'genrolla_export' );
        $views['genrolla_export'] = '<a href="' . esc_url( $url ) . '" class="button" style="margin-left:8px">' . esc_html__( 'Export CSV', 'genrolla' ) . '</a>';
    }
    return $views;
}
add_filter( 'views_edit-subscriber', 'genrolla_subscriber_views' );

/* Handle CSV export */
function genrolla_export_subscribers_csv() {
    if ( ! isset( $_GET['genrolla_export'] ) || ! current_user_can( 'manage_options' ) ) {
        return;
    }
    check_admin_referer( 'genrolla_export' );

    $subscribers = get_posts( array(
        'post_type'      => 'subscriber',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ) );

    header( 'Content-Type: text/csv; charset=utf-8' );
    header( 'Content-Disposition: attachment; filename=subscribers-' . gmdate( 'Y-m-d' ) . '.csv' );
    $out = fopen( 'php://output', 'w' );
    fputcsv( $out, array( 'ID', 'Email', 'Subscribed Date' ) );
    foreach ( $subscribers as $s ) {
        fputcsv( $out, array( $s->ID, $s->post_title, get_the_date( 'Y-m-d H:i', $s ) ) );
    }
    fclose( $out );
    exit;
}
add_action( 'admin_init', 'genrolla_export_subscribers_csv' );

/* ============================================================
 * RECOMMENDED PLUGINS NOTICE (soft, one-time dismiss)
 * ============================================================ */
function genrolla_recommended_plugins_notice() {
    if ( ! current_user_can( 'install_plugins' ) ) {
        return;
    }
    $dismissed = get_option( 'genrolla_plugins_notice_dismissed' );
    if ( $dismissed ) {
        return;
    }
    ?>
    <div class="notice notice-info is-dismissible genrolla-plugin-notice">
        <p style="font-weight:600"><?php esc_html_e( 'Genrolla Theme — Recommended plugin: Yoast SEO', 'genrolla' ); ?></p>
        <p style="margin-bottom:8px"><?php esc_html_e( 'Yoast SEO adds meta descriptions, XML sitemaps, and advanced SEO controls. The theme already includes schema markup, breadcrumbs, and a table of contents, so Yoast is optional but recommended for full SEO power.', 'genrolla' ); ?></p>
        <p style="margin:0">
            <a href="<?php echo esc_url( admin_url( 'plugin-install.php?tab=search&s=yoast+seo' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install Yoast SEO', 'genrolla' ); ?></a>
            <a href="<?php echo esc_url( wp_nonce_url( admin_url( 'admin.php?genrolla_dismiss_plugins=1' ), 'genrolla_dismiss' ) ); ?>" style="margin-left:10px"><?php esc_html_e( 'Dismiss', 'genrolla' ); ?></a>
        </p>
    </div>
    <?php
}
add_action( 'admin_notices', 'genrolla_recommended_plugins_notice' );

function genrolla_dismiss_plugins_notice() {
    if ( isset( $_GET['genrolla_dismiss_plugins'] ) && check_admin_referer( 'genrolla_dismiss' ) ) {
        update_option( 'genrolla_plugins_notice_dismissed', 1 );
        wp_safe_redirect( admin_url() );
        exit;
    }
}
add_action( 'admin_init', 'genrolla_dismiss_plugins_notice' );

/* ============================================================
 * DEMO CONTENT IMPORTER (one click)
 * ============================================================ */
require get_template_directory() . '/inc/demo-import.php';
