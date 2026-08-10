<?php
/**
 * The template for displaying comments
 *
 * @package Genrolla
 */

if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area" style="margin-top: 3rem; padding-top: 2rem; border-top: 2px solid #e0e0e0;">

    <?php if ( have_comments() ) : ?>
        <h3 class="comments-title">
            <?php
            $comments_number = get_comments_number();
            if ( '1' === $comments_number ) {
                printf( esc_html__( 'One comment', 'genrolla' ) );
            } else {
                printf(
                    esc_html( _nx( '%1$s comment', '%1$s comments', $comments_number, 'comments title', 'genrolla' ) ),
                    number_format_i18n( $comments_number )
                );
            }
            ?>
        </h3>

        <ol class="comment-list" style="list-style: none; padding: 0;">
            <?php
            wp_list_comments( array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 50,
            ) );
            ?>
        </ol>

        <?php
        the_comments_navigation();

        if ( ! comments_open() ) :
            ?>
            <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'genrolla' ); ?></p>
            <?php
        endif;

    endif;

    comment_form( array(
        'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title" style="margin-top: 2rem;">',
        'title_reply_after'  => '</h3>',
    ) );
    ?>

</div>
