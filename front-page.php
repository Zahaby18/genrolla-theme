<?php
/**
 * Front page — home with hero, trending, latest grid
 *
 * @package Genrolla
 */

get_header();

$hero_img   = get_theme_mod( 'genrolla_hero_image', '' );
$hero_style = $hero_img ? 'background-image:url(' . esc_url( $hero_img ) . ')' : '';
?>

<!-- HERO -->
<section class="hero">
    <div class="hero-bg" style="<?php echo esc_attr( $hero_style ); ?>"></div>
    <div class="container">
        <div class="hero-content">
            <span class="eyebrow"><span class="pulse"></span> <?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
            <h1><?php echo wp_kses_post( get_theme_mod( 'genrolla_hero_title', __( 'Level up your career, your way.', 'genrolla' ) ) ); ?></h1>
            <p class="sub"><?php echo esc_html( get_theme_mod( 'genrolla_hero_subtitle', __( 'Practical guides to help you work smart, not just work hard.', 'genrolla' ) ) ); ?></p>
            <div class="hero-cta">
                <?php
                $btn_url  = get_theme_mod( 'genrolla_hero_btn_url', '' );
                $btn_text = get_theme_mod( 'genrolla_hero_btn_text', __( 'Start reading free', 'genrolla' ) );
                if ( ! $btn_url ) {
                    $btn_url = '#genrolla-posts';
                }
                ?>
                <a href="<?php echo esc_url( $btn_url ); ?>" class="btn btn-neon"><?php echo esc_html( $btn_text ); ?> <i class="fa-solid fa-arrow-right"></i></a>
                <?php if ( get_page_by_path( 'about' ) ) : ?>
                    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'about' ) ) ); ?>" class="btn btn-ghost"><?php esc_html_e( 'About genrolla', 'genrolla' ); ?></a>
                <?php endif; ?>
            </div>
            <div class="hero-meta">
                <div class="stat"><div class="num"><?php echo esc_html( wp_count_posts()->publish ); ?>+</div><div class="lbl"><?php esc_html_e( 'Articles', 'genrolla' ); ?></div></div>
                <div class="stat"><div class="num">30K</div><div class="lbl"><?php esc_html_e( 'Readers / month', 'genrolla' ); ?></div></div>
                <div class="stat"><div class="num">4.9 <i class="fa-solid fa-star"></i></div><div class="lbl"><?php esc_html_e( 'Reader rating', 'genrolla' ); ?></div></div>
            </div>
        </div>
    </div>
    <div class="hero-scroll"><?php esc_html_e( 'scroll', 'genrolla' ); ?> <i class="fa-solid fa-arrow-down"></i></div>
</section>

<!-- TRENDING -->
<?php
$trending = genrolla_get_trending( 3 );
if ( ! empty( $trending ) ) :
    ?>
    <section class="section" style="padding-top:32px">
        <div class="container">
            <div class="section-head">
                <div>
                    <span class="kicker"><?php esc_html_e( 'Trending', 'genrolla' ); ?></span>
                    <h2><?php esc_html_e( 'Trending now', 'genrolla' ); ?></h2>
                </div>
                <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/' ) ); ?>" class="see-all"><?php esc_html_e( 'View all', 'genrolla' ); ?> <i class="fa-solid fa-arrow-right"></i></a>
            </div>
            <div class="featured-grid">
                <?php
                $i = 1;
                foreach ( $trending as $idx => $trend_post ) :
                    setup_postdata( $GLOBALS['post'] = $trend_post );
                    $is_first = ( 0 === $idx );
                    if ( $is_first ) :
                        ?>
                        <article <?php post_class( 'feature-card' ); ?>>
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="thumb" style="background-image:url('<?php echo esc_url( get_the_post_thumbnail_url( $trend_post, 'genrolla-featured' ) ); ?>')"></div>
                            <?php else : ?>
                                <div class="thumb thumb-fallback"><i class="fa-solid fa-newspaper"></i></div>
                            <?php endif; ?>
                            <div class="overlay"></div>
                            <span class="num"><?php echo esc_html( str_pad( $i, 2, '0', STR_PAD_LEFT ) ); ?></span>
                            <div class="card-body">
                                <?php echo genrolla_first_category( $trend_post->ID ); ?>
                                <h3><a href="<?php echo esc_url( get_permalink( $trend_post ) ); ?>"><?php echo esc_html( get_the_title( $trend_post ) ); ?></a></h3>
                                <div class="meta"><span><?php echo esc_html( genrolla_read_time( $trend_post->ID ) ); ?></span><span>·</span><span><?php echo esc_html( get_the_date( '', $trend_post->ID ) ); ?></span></div>
                            </div>
                        </article>
                        <?php
                    else :
                        if ( 1 === $idx ) {
                            echo '<div class="feature-side">';
                        }
                        ?>
                        <article <?php post_class( 'feature-card' ); ?>>
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="thumb" style="background-image:url('<?php echo esc_url( get_the_post_thumbnail_url( $trend_post, 'genrolla-card' ) ); ?>')"></div>
                            <?php else : ?>
                                <div class="thumb thumb-fallback"><i class="fa-solid fa-newspaper"></i></div>
                            <?php endif; ?>
                            <div class="overlay"></div>
                            <span class="num"><?php echo esc_html( str_pad( $i, 2, '0', STR_PAD_LEFT ) ); ?></span>
                            <div class="card-body">
                                <?php echo genrolla_first_category( $trend_post->ID ); ?>
                                <h3><a href="<?php echo esc_url( get_permalink( $trend_post ) ); ?>"><?php echo esc_html( get_the_title( $trend_post ) ); ?></a></h3>
                                <div class="meta"><span><?php echo esc_html( genrolla_read_time( $trend_post->ID ) ); ?></span><span>·</span><span><?php echo esc_html( get_the_date( '', $trend_post->ID ) ); ?></span></div>
                            </div>
                        </article>
                        <?php
                        if ( count( $trending ) - 1 === $idx ) {
                            echo '</div>';
                        }
                    endif;
                    $i++;
                endforeach;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- LATEST POSTS -->
<section class="section section-alt" id="genrolla-posts">
    <div class="container">
        <div class="section-head">
            <div>
                <span class="kicker"><?php esc_html_e( 'Fresh', 'genrolla' ); ?></span>
                <h2><?php esc_html_e( 'Latest articles', 'genrolla' ); ?></h2>
            </div>
            <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/' ) ); ?>" class="see-all"><?php esc_html_e( 'All articles', 'genrolla' ); ?> <i class="fa-solid fa-arrow-right"></i></a>
        </div>

        <?php
        // Category filter chips (from real categories)
        $cats = get_categories( array( 'hide_empty' => false, 'number' => 5 ) );
        if ( ! empty( $cats ) ) :
            ?>
            <div class="filter-chips" id="genrolla-cat-filter">
                <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/' ) ); ?>" class="chip active" data-cat=""><?php esc_html_e( 'All', 'genrolla' ); ?></a>
                <?php foreach ( $cats as $cat ) : ?>
                    <a href="<?php echo esc_url( get_category_link( $cat ) ); ?>" class="chip" data-cat="<?php echo esc_attr( $cat->term_id ); ?>"><?php echo esc_html( $cat->name ); ?></a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php
        $latest = new WP_Query( array(
            'posts_per_page'      => 6,
            'ignore_sticky_posts' => true,
            'no_found_rows'       => true,
        ) );
        ?>
        <?php if ( $latest->have_posts() ) : ?>
            <div class="post-grid">
                <?php
                while ( $latest->have_posts() ) :
                    $latest->the_post();
                    get_template_part( 'template-parts/card' );
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        <?php else : ?>
            <div class="no-posts">
                <p><?php esc_html_e( 'No posts yet. Use the "Import Demo Content" menu under Appearance to generate sample articles.', 'genrolla' ); ?></p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
get_footer();
