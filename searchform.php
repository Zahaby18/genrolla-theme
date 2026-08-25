<?php
/**
 * Search form (custom styling)
 *
 * @package Genrolla
 */
?>
<form role="search" method="get" class="genrolla-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="search" class="search-input" placeholder="<?php esc_attr_e( 'Search articles...', 'genrolla' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
    <button type="submit" class="btn btn-neon"><i class="fa-solid fa-magnifying-glass"></i></button>
</form>
