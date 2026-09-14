<?php
/**
 * Genrolla — FAQ (Accordion) feature
 *
 * Adds a FAQ repeater meta box to posts, renders an accordion section
 * after the post content, and outputs FAQPage schema for SEO.
 *
 * @package Genrolla
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* File-level guard */
if ( defined( 'GENROLLA_FAQ_LOADED' ) ) {
    return;
}
define( 'GENROLLA_FAQ_LOADED', true );

/* ============================================================
 * HELPERS
 * ============================================================ */

/**
 * Get sanitized FAQ items for a post.
 *
 * @param int|null $post_id Post ID.
 * @return array List of ['q' => string, 'a' => string].
 */
if ( ! function_exists( 'genrolla_get_faq' ) ) {
    function genrolla_get_faq( $post_id = null ) {
        $post_id = $post_id ? $post_id : get_the_ID();
        if ( ! $post_id ) {
            return array();
        }

        $raw = get_post_meta( $post_id, '_genrolla_faq', true );
        if ( ! is_array( $raw ) ) {
            return array();
        }

        $items = array();
        foreach ( $raw as $row ) {
            $q = isset( $row['q'] ) ? trim( wp_strip_all_tags( $row['q'] ) ) : '';
            $a = isset( $row['a'] ) ? trim( $row['a'] ) : '';
            if ( '' !== $q && '' !== $a ) {
                $items[] = array( 'q' => $q, 'a' => $a );
            }
        }

        return $items;
    }
}

/**
 * FAQ section heading (filterable).
 */
if ( ! function_exists( 'genrolla_faq_title' ) ) {
    function genrolla_faq_title() {
        return apply_filters( 'genrolla_faq_title', __( 'Frequently Asked Question', 'genrolla' ) );
    }
}

/* ============================================================
 * FRONT END — ACCORDION SECTION
 * ============================================================ */
if ( ! function_exists( 'genrolla_faq_render' ) ) {
    function genrolla_faq_render() {
        if ( ! is_singular( 'post' ) ) {
            return;
        }

        $items = genrolla_get_faq();
        if ( empty( $items ) ) {
            return;
        }
        ?>
        <section class="genrolla-faq" id="genrolla-faq">
            <h2 class="faq-heading"><?php echo esc_html( genrolla_faq_title() ); ?></h2>
            <div class="faq-list">
                <?php foreach ( $items as $index => $item ) : ?>
                    <details class="faq-item"<?php echo 0 === $index ? ' open' : ''; ?>>
                        <summary class="faq-question">
                            <h3><?php echo esc_html( $item['q'] ); ?></h3>
                            <span class="faq-icon" aria-hidden="true"></span>
                        </summary>
                        <div class="faq-answer">
                            <?php echo wp_kses_post( wpautop( $item['a'] ) ); ?>
                        </div>
                    </details>
                <?php endforeach; ?>
            </div>
        </section>
        <?php
    }
}

/* ============================================================
 * SEO — FAQPage JSON-LD SCHEMA
 * ============================================================ */
if ( ! function_exists( 'genrolla_faq_schema' ) ) {
    function genrolla_faq_schema() {
        if ( ! is_singular( 'post' ) ) {
            return;
        }

        $items = genrolla_get_faq();
        if ( empty( $items ) ) {
            return;
        }

        $entities = array();
        foreach ( $items as $item ) {
            $entities[] = array(
                '@type'          => 'Question',
                'name'           => $item['q'],
                'acceptedAnswer' => array(
                    '@type' => 'Answer',
                    'text'  => trim( wp_strip_all_tags( $item['a'] ) ),
                ),
            );
        }

        $schema = array(
            '@context'   => 'https://schema.org',
            '@type'      => 'FAQPage',
            'mainEntity' => $entities,
        );

        echo '<script type="application/ld+json">' . wp_json_encode( $schema ) . '</script>' . "\n";
    }
}
add_action( 'wp_head', 'genrolla_faq_schema', 21 );

/* ============================================================
 * ADMIN — META BOX REPEATER
 * ============================================================ */
if ( ! function_exists( 'genrolla_faq_add_meta_box' ) ) {
    function genrolla_faq_add_meta_box() {
        add_meta_box(
            'genrolla_faq',
            esc_html__( 'FAQ (Accordion)', 'genrolla' ),
            'genrolla_faq_meta_box_html',
            'post',
            'normal',
            'default'
        );
    }
}
add_action( 'add_meta_boxes', 'genrolla_faq_add_meta_box' );

if ( ! function_exists( 'genrolla_faq_meta_box_html' ) ) {
    function genrolla_faq_meta_box_html( $post ) {
        wp_nonce_field( 'genrolla_faq_save', 'genrolla_faq_nonce' );

        $items = get_post_meta( $post->ID, '_genrolla_faq', true );
        if ( ! is_array( $items ) ) {
            $items = array();
        }

        // Drop fully-empty rows for a cleaner editor.
        $items = array_values( array_filter( $items, function ( $row ) {
            return ! empty( $row['q'] ) || ! empty( $row['a'] );
        } ) );
        ?>
        <style>
            #genrolla_faq .genrolla-faq-row{border:1px solid #dcdcde;border-radius:6px;padding:12px;margin-bottom:10px;background:#fff}
            #genrolla_faq .genrolla-faq-row label{display:block;font-weight:600;margin-bottom:4px}
            #genrolla_faq .genrolla-faq-row input[type=text],
            #genrolla_faq .genrolla-faq-row textarea{width:100%}
            #genrolla_faq .genrolla-faq-row textarea{min-height:80px}
            #genrolla_faq .genrolla-faq-row .row-head{display:flex;justify-content:space-between;align-items:center;margin-bottom:8px}
            #genrolla_faq .genrolla-faq-row .row-num{font-weight:700;color:#646970}
            #genrolla_faq .genrolla-faq-remove{color:#b32d2e;cursor:pointer;background:none;border:0;padding:0;text-decoration:underline}
            #genrolla_faq .genrolla-faq-hint{color:#646970;margin:0 0 12px}
        </style>

        <p class="genrolla-faq-hint">
            <?php esc_html_e( 'Add question and answer pairs. The FAQ section and its schema markup only appear on the front end when at least one pair is filled in.', 'genrolla' ); ?>
        </p>

        <div id="genrolla-faq-rows">
            <?php foreach ( $items as $index => $item ) : ?>
                <div class="genrolla-faq-row">
                    <div class="row-head">
                        <span class="row-num">#<?php echo esc_html( $index + 1 ); ?></span>
                        <button type="button" class="genrolla-faq-remove"><?php esc_html_e( 'Remove', 'genrolla' ); ?></button>
                    </div>
                    <label><?php esc_html_e( 'Question (H3)', 'genrolla' ); ?></label>
                    <input type="text" name="genrolla_faq[<?php echo esc_attr( $index ); ?>][q]" value="<?php echo esc_attr( isset( $item['q'] ) ? $item['q'] : '' ); ?>">
                    <label style="margin-top:8px"><?php esc_html_e( 'Answer', 'genrolla' ); ?></label>
                    <textarea name="genrolla_faq[<?php echo esc_attr( $index ); ?>][a]"><?php echo esc_textarea( isset( $item['a'] ) ? $item['a'] : '' ); ?></textarea>
                </div>
            <?php endforeach; ?>
        </div>

        <p>
            <button type="button" class="button button-secondary" id="genrolla-faq-add">
                <?php esc_html_e( 'Add FAQ item', 'genrolla' ); ?>
            </button>
        </p>

        <script type="text/template" id="genrolla-faq-tpl">
            <div class="genrolla-faq-row">
                <div class="row-head">
                    <span class="row-num">#__NUM__</span>
                    <button type="button" class="genrolla-faq-remove"><?php esc_html_e( 'Remove', 'genrolla' ); ?></button>
                </div>
                <label><?php esc_html_e( 'Question (H3)', 'genrolla' ); ?></label>
                <input type="text" name="genrolla_faq[__INDEX__][q]" value="">
                <label style="margin-top:8px"><?php esc_html_e( 'Answer', 'genrolla' ); ?></label>
                <textarea name="genrolla_faq[__INDEX__][a]"></textarea>
            </div>
        </script>
        <?php
    }
}

/* Save */
if ( ! function_exists( 'genrolla_faq_save_meta' ) ) {
    function genrolla_faq_save_meta( $post_id ) {
        if ( ! isset( $_POST['genrolla_faq_nonce'] ) ) {
            return;
        }
        if ( ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['genrolla_faq_nonce'] ) ), 'genrolla_faq_save' ) ) {
            return;
        }
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        $clean = array();

        if ( isset( $_POST['genrolla_faq'] ) && is_array( $_POST['genrolla_faq'] ) ) {
            // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.MissingUnslash
            $rows = wp_unslash( $_POST['genrolla_faq'] );
            foreach ( $rows as $row ) {
                if ( ! is_array( $row ) ) {
                    continue;
                }
                $q = isset( $row['q'] ) ? sanitize_text_field( $row['q'] ) : '';
                $a = isset( $row['a'] ) ? wp_kses_post( $row['a'] ) : '';
                if ( '' === trim( $q ) && '' === trim( wp_strip_all_tags( $a ) ) ) {
                    continue;
                }
                $clean[] = array(
                    'q' => $q,
                    'a' => $a,
                );
            }
        }

        if ( empty( $clean ) ) {
            delete_post_meta( $post_id, '_genrolla_faq' );
        } else {
            update_post_meta( $post_id, '_genrolla_faq', $clean );
        }
    }
}
add_action( 'save_post_post', 'genrolla_faq_save_meta' );

/* Admin repeater JS */
if ( ! function_exists( 'genrolla_faq_admin_scripts' ) ) {
    function genrolla_faq_admin_scripts( $hook ) {
        if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
            return;
        }
        wp_enqueue_script(
            'genrolla-faq-admin',
            get_template_directory_uri() . '/assets/js/faq-admin.js',
            array(),
            GENROLLA_VERSION,
            true
        );
    }
}
add_action( 'admin_enqueue_scripts', 'genrolla_faq_admin_scripts' );
