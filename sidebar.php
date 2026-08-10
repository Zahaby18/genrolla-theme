<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Genrolla
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
    return;
}
?>

<aside id="secondary" class="sidebar">
    
    <!-- Ad Zone Sidebar -->
    <div class="ad-zone ad-zone-sidebar">
        <!-- Ad Space: Sidebar (300x250 or 300x600) -->
        <?php if ( is_active_sidebar( 'sidebar-ad' ) ) {
            dynamic_sidebar( 'sidebar-ad' );
        } else {
            echo esc_html__( 'Ad Space: Sidebar', 'genrolla' );
        } ?>
    </div>

    <?php dynamic_sidebar( 'sidebar-1' ); ?>

</aside>
