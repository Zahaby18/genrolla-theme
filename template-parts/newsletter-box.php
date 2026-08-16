<?php
/**
 * Newsletter Box Template Part
 *
 * @package Genrolla
 */

$newsletter_title = get_theme_mod( 'genrolla_newsletter_title', esc_html__( 'Subscribe to Our Newsletter', 'genrolla' ) );
$newsletter_text  = get_theme_mod( 'genrolla_newsletter_text', esc_html__( 'Get the latest posts delivered right to your inbox.', 'genrolla' ) );
?>

<div class="newsletter-box">
    <h3><?php echo esc_html( $newsletter_title ); ?></h3>
    <p><?php echo esc_html( $newsletter_text ); ?></p>
    
    <form class="newsletter-form" action="#" method="post">
        <input type="email" name="email" placeholder="<?php esc_attr_e( 'Enter your email address', 'genrolla' ); ?>" required>
        <button type="submit"><?php esc_html_e( 'Subscribe', 'genrolla' ); ?></button>
    </form>
    
    <p style="font-size: 0.75rem; margin-top: 1rem; opacity: 0.8;">
        <?php esc_html_e( 'We respect your privacy. Unsubscribe at any time.', 'genrolla' ); ?>
    </p>
</div>
