<?php
/**
 * Search results template
 *
 * @package Genrolla
 */

get_header();
?>

<div class="page-hero">
    <div class="container">
        <?php genrolla_breadcrumb(); ?>
        <span class="kicker"><?php esc_html_e( 'Search', 'genrolla' ); ?></span>
        <h1><?php printf( esc_html__( 'Results for: %s', 'genrolla' ), '<span class="hl">' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
        <?php if ( have_posts() ) : ?>
            <div class="count"><?php printf( esc_html__( '%d posts found', 'genrolla' ), (int) $GLOBALS['wp_query']->found_posts ); ?></div>
        <?php endif; ?>
    </div>
</div>

<div class="section" style="padding-top:8px">
    <div class="container">
        <?php if ( have_posts() ) : ?>
            <div class="post-grid">
                <?php
                while ( have_posts() ) :
                    the_post();
                    get_template_part( 'template-parts/card' );
                endwhile;
                ?>
            </div>
            <?php
            the_posts_pagination( array(
                'mid_size'  => 2,
                'prev_text' => '<i class="fa-solid fa-arrow-left"></i>',
                'next_text' => '<i class="fa-solid fa-arrow-right"></i>',
            ) );
            ?>
        <?php else : ?>
            <div class="no-posts">
                <p><?php esc_html_e( 'Nothing found. Try different keywords.', 'genrolla' ); ?></p>
                <?php get_search_form(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
get_footer();
