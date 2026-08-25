<?php
/**
 * Page template (About, Contact, etc.)
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
            <span class="kicker"><?php esc_html_e( 'Page', 'genrolla' ); ?></span>
            <h1><?php the_title(); ?></h1>
            <?php if ( has_excerpt() ) : ?>
                <div class="desc"><?php echo esc_html( get_the_excerpt() ); ?></div>
            <?php endif; ?>
        </div>
    </div>

    <div class="section" style="padding-top:16px">
        <div class="container">
            <div class="single-grid">
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'single-content page-content' ); ?>>
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
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>

    <?php
endwhile;

get_footer();
