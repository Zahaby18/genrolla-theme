<?php
/**
 * The template for displaying single posts
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
            <?php
            while ( have_posts() ) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="single-post-header">
                        <?php genrolla_breadcrumbs(); ?>
                        
                        <?php
                        $categories = get_the_category();
                        if ( ! empty( $categories ) ) {
                            echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '" class="post-category">' . esc_html( $categories[0]->name ) . '</a>';
                        }
                        ?>

                        <h1 class="single-post-title"><?php the_title(); ?></h1>

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
                            <span class="post-comments">
                                <svg width="14" height="14" fill="currentColor" viewBox="0 0 16 16" style="vertical-align: -2px;">
                                    <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
                                </svg>
                                <?php comments_number( '0', '1', '%' ); ?>
                            </span>
                        </div>
                    </header>

                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-featured-image mb-4">
                            <?php the_post_thumbnail( 'large' ); ?>
                        </div>
                    <?php endif; ?>

                    <div class="post-content">
                        <?php the_content(); ?>
                    </div>

                    <?php
                    // Tags
                    $tags = get_the_tags();
                    if ( $tags ) {
                        echo '<div class="post-tags mt-4">';
                        foreach ( $tags as $tag ) {
                            echo '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" class="tag">#' . esc_html( $tag->name ) . '</a> ';
                        }
                        echo '</div>';
                    }
                    ?>

                    <?php
                    // Newsletter box in single post
                    if ( get_theme_mod( 'genrolla_newsletter_show_single', true ) ) {
                        get_template_part( 'template-parts/newsletter-box' );
                    }
                    ?>

                    <?php
                    // Related Posts
                    $related_posts = genrolla_get_related_posts( get_the_ID(), 3 );
                    if ( ! empty( $related_posts ) ) {
                        ?>
                        <div class="related-posts">
                            <h3><?php esc_html_e( 'You May Also Like', 'genrolla' ); ?></h3>
                            <div class="related-posts-grid">
                                <?php foreach ( $related_posts as $related_post ) : ?>
                                    <article class="post-card">
                                        <?php if ( has_post_thumbnail( $related_post->ID ) ) : ?>
                                            <a href="<?php echo esc_url( get_permalink( $related_post->ID ) ); ?>">
                                                <?php echo get_the_post_thumbnail( $related_post->ID, 'medium', array( 'class' => 'post-thumbnail' ) ); ?>
                                            </a>
                                        <?php endif; ?>
                                        <div class="post-card-content">
                                            <h4 class="post-card-title">
                                                <a href="<?php echo esc_url( get_permalink( $related_post->ID ) ); ?>">
                                                    <?php echo esc_html( get_the_title( $related_post->ID ) ); ?>
                                                </a>
                                            </h4>
                                            <div class="post-meta">
                                                <span class="post-date"><?php echo get_the_date( '', $related_post->ID ); ?></span>
                                            </div>
                                        </div>
                                    </article>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                    <?php
                    // Comments
                    if ( comments_open() || get_comments_number() ) {
                        comments_template();
                    }
                    ?>
                </article>
                <?php
            endwhile;
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
