<?php
/**
 * Single post template
 *
 * @package Genrolla
 */

get_header();
?>

<div class="section">
    <div class="container">
        <div class="single-grid">
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'single-content' ); ?>>

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php genrolla_breadcrumb(); ?>

                    <?php echo genrolla_first_category(); ?>

                    <h1 class="single-title"><?php the_title(); ?></h1>

                    <div class="single-meta">
                        <span class="avatar"><?php echo esc_html( strtoupper( mb_substr( get_the_author(), 0, 1 ) ) ); ?></span>
                        <span><span class="author-name"><?php the_author(); ?></span></span>
                        <span class="sep">·</span>
                        <span><?php echo esc_html( get_the_date() ); ?></span>
                        <span class="sep">·</span>
                        <span><?php echo esc_html( genrolla_read_time() ); ?></span>
                        <span class="sep">·</span>
                        <span><?php echo esc_html( get_comments_number() ); ?> <?php esc_html_e( 'comments', 'genrolla' ); ?></span>
                    </div>

                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="single-featured">
                            <?php the_post_thumbnail( 'genrolla-featured' ); ?>
                        </div>
                    <?php endif; ?>

                    <div class="post-body" id="genrolla-post-body">
                        <?php the_content(); ?>
                    </div>

                    <?php
                    $tags = get_the_tags();
                    if ( $tags ) :
                        ?>
                        <div class="post-tags">
                            <?php foreach ( $tags as $tag ) : ?>
                                <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="tag">#<?php echo esc_html( $tag->name ); ?></a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <?php genrolla_author_box(); ?>

                    <?php
                    // Prev / Next
                    $prev = get_previous_post();
                    $next = get_next_post();
                    if ( $prev || $next ) :
                        ?>
                        <div class="post-nav">
                            <?php if ( $prev ) : ?>
                                <a href="<?php echo esc_url( get_permalink( $prev ) ); ?>">
                                    <span class="nav-lbl"><i class="fa-solid fa-arrow-left"></i> <?php esc_html_e( 'Previous', 'genrolla' ); ?></span>
                                    <span class="nav-title"><?php echo esc_html( get_the_title( $prev ) ); ?></span>
                                </a>
                            <?php endif; ?>
                            <?php if ( $next ) : ?>
                                <a href="<?php echo esc_url( get_permalink( $next ) ); ?>" style="text-align:right">
                                    <span class="nav-lbl"><?php esc_html_e( 'Next', 'genrolla' ); ?> <i class="fa-solid fa-arrow-right"></i></span>
                                    <span class="nav-title"><?php echo esc_html( get_the_title( $next ) ); ?></span>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php
                    if ( comments_open() || get_comments_number() ) {
                        comments_template();
                    }
                    ?>

                <?php endwhile; ?>
            </article>

            <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php
get_footer();
