<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Genrolla
 */

get_header();
?>

<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <div class="error-404 not-found" style="text-align: center; padding: 4rem 2rem;">
                <h1 style="font-size: 6rem; font-weight: 700; color: #0066cc; margin: 0;">404</h1>
                <h2 style="font-size: 2rem; margin: 1rem 0;"><?php esc_html_e( 'Oops! Page Not Found', 'genrolla' ); ?></h2>
                <p style="font-size: 1.125rem; color: #666; margin: 1rem 0 2rem;">
                    <?php esc_html_e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'genrolla' ); ?>
                </p>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary" style="display: inline-block; padding: 0.75rem 2rem; background: #0066cc; color: #fff; text-decoration: none; border-radius: 4px; font-weight: 600;">
                    <?php esc_html_e( 'Go Back Home', 'genrolla' ); ?>
                </a>

                <div style="margin-top: 3rem;">
                    <h3 style="margin-bottom: 1rem;"><?php esc_html_e( 'Try searching:', 'genrolla' ); ?></h3>
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
