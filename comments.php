<?php
/**
 * Comments template
 *
 * @package Genrolla
 */

if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php if ( have_comments() ) : ?>
        <h3 class="comments-title">
            <?php
            $n = get_comments_number();
            printf( _n( '1 comment', '%d comments', $n, 'genrolla' ), number_format_i18n( $n ) );
            ?>
        </h3>
        <ol class="comment-list">
            <?php
            wp_list_comments( array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 48,
            ) );
            ?>
        </ol>
        <?php the_comments_navigation(); ?>
        <?php if ( ! comments_open() ) : ?>
            <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'genrolla' ); ?></p>
        <?php endif; ?>
    <?php endif; ?>

    <?php
    comment_form( array(
        'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
        'title_reply_after'  => '</h3>',
    ) );
    ?>
</div>
