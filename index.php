<?php
/**
 * Blog index template (fallback when no static front page)
 *
 * @package Genrolla
 */

get_header();
?>

<div class="page-hero">
    <div class="container">
        <?php genrolla_breadcrumb(); ?>
        <span class="kicker"><?php esc_html_e( 'Blog', 'genrolla' ); ?></span>
        <h1><?php esc_html_e( 'Latest articles', 'genrolla' ); ?></h1>
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
                <p><?php esc_html_e( 'No posts yet.', 'genrolla' ); ?></p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
get_footer();
