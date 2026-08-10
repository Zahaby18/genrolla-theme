<?php
/**
 * The template for displaying pages
 *
 * @package Genrolla
 */

get_header();
?>

<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <?php
            while ( have_posts() ) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header mb-4">
                        <h1 class="entry-title" style="font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem;">
                            <?php the_title(); ?>
                        </h1>
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
                    if ( comments_open() || get_comments_number() ) {
                        comments_template();
                    }
                    ?>
                </article>
                <?php
            endwhile;
            ?>
        </div>
    </div>
</div>

<?php
get_footer();
