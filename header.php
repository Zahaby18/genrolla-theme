<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="announce">
    <?php
    $announce = get_theme_mod( 'genrolla_announce_text', '' );
    if ( $announce ) {
        echo wp_kses_post( $announce );
    }
    ?>
</div>

<header class="site-header">
    <div class="container header-inner">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
            <?php
            if ( has_custom_logo() ) {
                the_custom_logo();
            } else {
                echo bloginfo( 'name' ) ? '<span class="logo-text">' . esc_html( get_bloginfo( 'name' ) ) . '</span>' : '';
            }
            ?>
            <span class="dot">.</span>
        </a>

        <nav class="main-nav" role="navigation" aria-label="<?php esc_attr_e( 'Primary Navigation', 'genrolla' ); ?>">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'main-nav-list',
                'fallback_cb'    => 'genrolla_default_menu',
            ) );
            ?>
        </nav>

        <div class="header-actions">
            <button class="icon-btn" id="genrolla-search-toggle" aria-label="<?php esc_attr_e( 'Search', 'genrolla' ); ?>">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
            <a href="#genrolla-newsletter" class="btn btn-neon"><?php esc_html_e( 'Subscribe', 'genrolla' ); ?></a>
            <button class="menu-toggle" id="genrolla-menu-toggle" aria-label="<?php esc_attr_e( 'Menu', 'genrolla' ); ?>">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
    </div>

    <!-- Search drawer -->
    <div class="search-drawer" id="genrolla-search-drawer">
        <div class="container">
            <?php get_search_form(); ?>
        </div>
    </div>
</header>
