<?php
/**
 * Post card template part
 *
 * @package Genrolla
 */
?>
<article <?php post_class( 'post-card' ); ?>>
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="thumb" style="background-image:url('<?php echo esc_url( get_the_post_thumbnail_url( null, 'genrolla-card' ) ); ?>')">
            <?php echo genrolla_first_category(); ?>
        </div>
    <?php else : ?>
        <div class="thumb thumb-fallback">
            <i class="fa-solid fa-newspaper"></i>
            <?php echo genrolla_first_category(); ?>
        </div>
    <?php endif; ?>
    <div class="body">
        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <p class="excerpt"><?php echo esc_html( genrolla_excerpt() ); ?></p>
        <?php
        $tags = get_the_tags();
        if ( $tags ) :
            ?>
            <div class="tags">
                <?php foreach ( array_slice( $tags, 0, 3 ) as $tag ) : ?>
                    <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="tag">#<?php echo esc_html( $tag->name ); ?></a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div class="meta">
            <span class="avatar"><?php echo esc_html( strtoupper( mb_substr( get_the_author(), 0, 1 ) ) ); ?></span>
            <span><?php echo esc_html( get_the_author() ); ?></span>
            <span class="dot-sep">·</span>
            <span><?php echo esc_html( genrolla_read_time() ); ?></span>
        </div>
    </div>
</article>
