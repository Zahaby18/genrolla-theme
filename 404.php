<?php
/**
 * 404 template
 *
 * @package Genrolla
 */

get_header();
?>

<div class="section">
    <div class="container">
        <div class="error-404">
            <span class="error-code">404</span>
            <h1><?php esc_html_e( 'Halaman nggak ketemu.', 'genrolla' ); ?></h1>
            <p><?php esc_html_e( 'Mungkin link-nya salah, atau halamannya udah dipindah. Coba cari lagi:', 'genrolla' ); ?></p>
            <?php get_search_form(); ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-neon" style="margin-top:16px">
                <?php esc_html_e( 'Kembali ke Home', 'genrolla' ); ?> <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

<?php
get_footer();
