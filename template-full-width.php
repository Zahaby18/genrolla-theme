<?php
/**
 * Template Name: Full Width
 * Description: Halaman full width tanpa sidebar. Cocok untuk Contact, Landing page, Privacy Policy, dll.
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
            <span class="kicker"><?php esc_html_e( 'Halaman', 'genrolla' ); ?></span>
            <h1><?php the_title(); ?></h1>
            <?php if ( has_excerpt() ) : ?>
                <div class="desc"><?php echo esc_html( get_the_excerpt() ); ?></div>
            <?php endif; ?>
        </div>
    </div>

    <div class="section" style="padding-top:16px">
        <div class="container">
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'single-content page-content fullwidth' ); ?>>
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="single-featured">
                        <?php the_post_thumbnail( 'genrolla-featured' ); ?>
                    </div>
                <?php endif; ?>
                <div class="post-body">
                    <?php the_content(); ?>
                </div>
                <?php
                if ( comments_open() || get_comments_number() ) {
                    comments_template();
                }
                ?>
            </article>
        </div>
    </div>

    <?php
endwhile;

get_footer();
