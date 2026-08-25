<?php
/**
 * Template Name: About
 * Description: About page — hero header + full-width content (no sidebar). Perfect for an "About Us" page.
 *
 * @package Genrolla
 */

get_header();

while ( have_posts() ) :
    the_post();
    ?>

    <div class="page-hero">
        <div class="container">
            <?php genrolla_breadcrumb(); ?>
            <span class="kicker"><?php esc_html_e( 'About us', 'genrolla' ); ?></span>
            <h1><?php the_title(); ?></h1>
            <?php if ( has_excerpt() ) : ?>
                <div class="desc"><?php echo esc_html( get_the_excerpt() ); ?></div>
            <?php endif; ?>
        </div>
    </div>

    <div class="section" style="padding-top:16px">
        <div class="container">
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'about-content' ); ?>>
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="single-featured">
                        <?php the_post_thumbnail( 'genrolla-featured' ); ?>
                    </div>
                <?php endif; ?>
                <div class="post-body">
                    <?php the_content(); ?>
                </div>
            </article>
        </div>
    </div>

    <?php
endwhile;

get_footer();
