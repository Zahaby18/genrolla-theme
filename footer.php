    <!-- NEWSLETTER -->
    <section class="section section-alt" id="genrolla-newsletter">
        <div class="container">
            <div class="newsletter">
                <div>
                    <h2><?php echo esc_html( get_theme_mod( 'genrolla_newsletter_title', __( 'Don\'t miss weekly career insights.', 'genrolla' ) ) ); ?></h2>
                    <p><?php echo esc_html( get_theme_mod( 'genrolla_newsletter_text', __( 'Join 30,000+ readers getting career & finance tips straight to their inbox. Free.', 'genrolla' ) ) ); ?></p>
                    <?php
                    if ( isset( $_GET['subscribed'] ) ) {
                        echo '<p class="nl-notice nl-success"><i class="fa-solid fa-circle-check"></i> ' . esc_html__( 'Thanks! Your email has been subscribed.', 'genrolla' ) . '</p>';
                    } elseif ( isset( $_GET['subscribe_error'] ) ) {
                        $err = sanitize_key( wp_unslash( $_GET['subscribe_error'] ) );
                        if ( 'duplicate' === $err ) {
                            $msg = __( 'This email is already subscribed.', 'genrolla' );
                        } elseif ( 'invalid' === $err ) {
                            $msg = __( 'Please enter a valid email address.', 'genrolla' );
                        } else {
                            $msg = __( 'Something went wrong. Please try again.', 'genrolla' );
                        }
                        echo '<p class="nl-notice nl-error"><i class="fa-solid fa-circle-exclamation"></i> ' . esc_html( $msg ) . '</p>';
                    }
                    ?>
                </div>
                <?php
                $shortcode = get_theme_mod( 'genrolla_newsletter_shortcode', '' );
                $action    = get_theme_mod( 'genrolla_newsletter_form_action', '' );
                if ( $shortcode ) {
                    echo '<div class="nl-form">' . do_shortcode( $shortcode ) . '</div>';
                } else {
                    ?>
                    <form class="nl-form" action="<?php echo esc_url( $action ? $action : home_url( '/' ) ); ?>" method="post">
                        <?php if ( ! $action ) : ?>
                            <input type="hidden" name="genrolla_subscribe" value="1">
                            <input type="text" name="genrolla_hp" value="" style="display:none" tabindex="-1" autocomplete="off" aria-hidden="true">
                        <?php endif; ?>
                        <input type="email" name="email" placeholder="<?php esc_attr_e( 'Your email...', 'genrolla' ); ?>" required>
                        <button class="btn btn-neon" type="submit"><?php esc_html_e( 'Subscribe', 'genrolla' ); ?></button>
                    </form>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>

    <footer class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="about">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo" style="font-size:22px">
                        <?php echo esc_html( get_bloginfo( 'name' ) ); ?><span class="dot">.</span>
                    </a>
                    <p><?php echo esc_html( get_bloginfo( 'description' ) ); ?></p>
                    <div class="social">
                        <?php
                        $socials = array( 'facebook', 'x-twitter', 'instagram', 'youtube', 'tiktok', 'linkedin' );
                        foreach ( $socials as $social ) {
                            $url = get_theme_mod( "genrolla_social_{$social}", '' );
                            if ( $url ) {
                                echo '<a href="' . esc_url( $url ) . '" class="icon-btn" target="_blank" rel="noopener"><i class="fa-brands fa-' . esc_attr( $social ) . '"></i></a>';
                            }
                        }
                        ?>
                    </div>
                </div>

                <?php for ( $i = 1; $i <= 3; $i++ ) : ?>
                    <div>
                        <?php if ( is_active_sidebar( "footer-$i" ) ) : ?>
                            <?php dynamic_sidebar( "footer-$i" ); ?>
                        <?php endif; ?>
                    </div>
                <?php endfor; ?>
            </div>

            <div class="footer-bottom">
                <span>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>. <?php echo esc_html( get_theme_mod( 'genrolla_copyright', __( 'All rights reserved.', 'genrolla' ) ) ); ?></span>
                <?php $credit = get_theme_mod( 'genrolla_footer_credit', '' ); ?>
                <?php if ( $credit ) : ?>
                    <span class="made"><?php echo wp_kses_post( $credit ); ?></span>
                <?php endif; ?>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
