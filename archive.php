<?php
/**
 * Archive template — category, tag, author, date
 *
 * @package Genrolla
 */

get_header();

$term = get_queried_object();
?>

<div class="page-hero">
    <div class="container">
        <?php genrolla_breadcrumb(); ?>

        <span class="kicker">
            <?php
            if ( is_category() ) {
                esc_html_e( 'Category', 'genrolla' );
            } elseif ( is_tag() ) {
                esc_html_e( 'Tag', 'genrolla' );
            } elseif ( is_author() ) {
                esc_html_e( 'Author', 'genrolla' );
            } elseif ( is_date() ) {
                esc_html_e( 'Archive', 'genrolla' );
            } else {
                esc_html_e( 'Blog', 'genrolla' );
            }
            ?>
        </span>

        <h1>
            <?php
            if ( is_category() ) {
                single_cat_title();
            } elseif ( is_tag() ) {
                single_tag_title();
            } elseif ( is_author() ) {
                the_author();
            } elseif ( is_date() ) {
                the_archive_title();
            } else {
                esc_html_e( 'Blog', 'genrolla' );
            }
            ?>
        </h1>

        <?php
        $desc = term_description();
        if ( $desc ) :
            ?>
            <div class="desc"><?php echo wp_kses_post( $desc ); ?></div>
        <?php endif; ?>

        <div class="count">
            <?php
            global $wp_query;
            printf( esc_html__( 'Showing %d posts', 'genrolla' ), (int) $wp_query->found_posts );
            ?>
        </div>
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
                'class'     => 'pagination',
            ) );
            ?>
        <?php else : ?>
            <div class="no-posts">
                <p><?php esc_html_e( 'No posts here yet.', 'genrolla' ); ?></p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
get_footer();
