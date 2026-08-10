<?php
/**
 * The main template file - Homepage
 *
 * @package Genrolla
 */

get_header();
?>

<div class="container py-4">
    
    <?php
    // Ad Zone Header (only on homepage)
    if ( is_home() ) {
        ?>
        <div class="ad-zone ad-zone-header">
            <!-- Ad Zone: Header Banner (728x90 or 970x90) -->
            <?php if ( is_active_sidebar( 'header-ad' ) ) {
                dynamic_sidebar( 'header-ad' );
            } else {
                echo esc_html__( 'Ad Space: Header Banner', 'genrolla' );
            } ?>
        </div>
        <?php
    }
    ?>

    <?php
    $sidebar_position = get_theme_mod( 'genrolla_sidebar_position', 'right' );
    $has_sidebar = $sidebar_position !== 'none' && is_active_sidebar( 'sidebar-1' );
    ?>

    <div class="row">
        <?php if ( $has_sidebar && $sidebar_position === 'left' ) : ?>
            <div class="col-lg-4">
                <?php get_sidebar(); ?>
            </div>
        <?php endif; ?>

        <div class="<?php echo $has_sidebar ? 'col-lg-8' : 'col-12'; ?>">
            <?php if ( have_posts() ) : ?>
                
                <div class="blog-grid">
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>
                            <?php if ( has_post_thumbnail() ) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'medium_large', array( 'class' => 'post-thumbnail' ) ); ?>
                                </a>
                            <?php endif; ?>

                            <div class="post-card-content">
                                <?php
                                $categories = get_the_category();
                                if ( ! empty( $categories ) ) {
                                    echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '" class="post-category">' . esc_html( $categories[0]->name ) . '</a>';
                                }
                                ?>

                                <h2 class="post-card-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>

                                <div class="post-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>

                                <div class="post-meta">
                                    <span class="post-date">
                                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 16 16" style="vertical-align: -2px;">
                                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                        </svg>
                                        <?php echo get_the_date(); ?>
                                    </span>
                                    <span class="post-author">
                                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 16 16" style="vertical-align: -2px;">
                                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                        </svg>
                                        <?php the_author(); ?>
                                    </span>
                                </div>
                            </div>
                        </article>
                        <?php
                    endwhile;
                    ?>
                </div>

                <?php
                // Pagination
                the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => esc_html__( '&laquo; Previous', 'genrolla' ),
                    'next_text' => esc_html__( 'Next &raquo;', 'genrolla' ),
                ) );
                ?>

            <?php else : ?>
                <div class="no-posts">
                    <h2><?php esc_html_e( 'Nothing Found', 'genrolla' ); ?></h2>
                    <p><?php esc_html_e( 'It seems we can\'t find what you\'re looking for.', 'genrolla' ); ?></p>
                </div>
            <?php endif; ?>

            <?php
            // Newsletter box on homepage
            if ( is_home() && get_theme_mod( 'genrolla_newsletter_show_home', true ) ) {
                get_template_part( 'template-parts/newsletter-box' );
            }
            ?>
        </div>

        <?php if ( $has_sidebar && $sidebar_position === 'right' ) : ?>
            <div class="col-lg-4">
                <?php get_sidebar(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
get_footer();
