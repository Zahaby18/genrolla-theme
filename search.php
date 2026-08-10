<?php
/**
 * The template for displaying search results pages
 *
 * @package Genrolla
 */

get_header();
?>

<div class="container py-4">
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
                <header class="page-header mb-4">
                    <h1 class="page-title">
                        <?php
                        printf(
                            esc_html__( 'Search Results for: %s', 'genrolla' ),
                            '<span>' . get_search_query() . '</span>'
                        );
                        ?>
                    </h1>
                </header>

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
                                    <span class="post-date"><?php echo get_the_date(); ?></span>
                                    <span class="post-author"><?php the_author(); ?></span>
                                </div>
                            </div>
                        </article>
                        <?php
                    endwhile;
                    ?>
                </div>

                <?php
                the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => esc_html__( '&laquo; Previous', 'genrolla' ),
                    'next_text' => esc_html__( 'Next &raquo;', 'genrolla' ),
                ) );
                ?>

            <?php else : ?>
                <div class="no-posts">
                    <h2><?php esc_html_e( 'Nothing Found', 'genrolla' ); ?></h2>
                    <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'genrolla' ); ?></p>
                    <?php get_search_form(); ?>
                </div>
            <?php endif; ?>
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
