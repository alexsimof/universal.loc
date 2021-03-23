<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package universal-theme
 */

if ( ! is_active_sidebar( 'sidebar-post' ) ) {
	return;
}
?>


<aside class="sidebar-footer-page">
	<?php dynamic_sidebar( 'sidebar-post' ); ?>
</aside>


<!-- sidebar-post-page -->
