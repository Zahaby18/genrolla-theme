<?php
/**
 * Author box template part
 *
 * @package Genrolla
 */

$author_id = get_the_author_meta( 'ID' );
?>
<div class="author-box">
    <div class="avatar"><?php echo esc_html( strtoupper( mb_substr( get_the_author(), 0, 1 ) ) ); ?></div>
    <div>
        <h4><?php the_author(); ?></h4>
        <p><?php echo esc_html( get_the_author_meta( 'description', $author_id ) ? get_the_author_meta( 'description', $author_id ) : __( 'Penulis di blog ini.', 'genrolla' ) ); ?></p>
        <a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>" class="btn btn-ghost" style="margin-top:10px;padding:7px 16px;font-size:13px">
            <?php esc_html_e( 'Lihat semua artikel', 'genrolla' ); ?> <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
</div>
