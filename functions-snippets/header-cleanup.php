<?php 

/*
	Cleanup stupid WP shit from the header
*/

/*      Remove useless links from the header  */
function gdq_removeHeadLinks() {
    remove_action('wp_head', 'feed_links_extra', 3 );
    remove_action('wp_head', 'feed_links', 2 );
    remove_action('wp_head', 'rsd_link' );
    remove_action('wp_head', 'wlwmanifest_link' );
    remove_action('wp_head', 'index_rel_link' );
    remove_action('wp_head', 'parent_post_rel_link', 10, 0 );
    remove_action('wp_head', 'start_post_rel_link', 10, 0 );
    remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0 );
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);    
    remove_action('wp_head', 'wp_generator' );
}
add_action('init', 'gdq_removeHeadLinks');

/*      Remove version numbers after css, js files      */
// remove version from head
remove_action('wp_head', 'wp_generator');

// remove version from rss
add_filter('the_generator', '__return_empty_string');

// remove version from scripts and styles
function gdq_remove_version_scripts_styles($src) {
	
	if( is_admin() || wp_doing_ajax() ) return $src;
	
	if (strpos($src, 'ver=')) {
		$src = remove_query_arg('ver', $src);
	}
	return $src;
}
add_filter('style_loader_src', 'gdq_remove_version_scripts_styles', 9999);
add_filter('script_loader_src', 'gdq_remove_version_scripts_styles', 9999);

/*      Remove emoji junk from the header   */
remove_action('wp_head', 'print_emoji_detection_script', 7 );
remove_action('admin_print_scripts', 'print_emoji_detection_script' );
remove_action('wp_print_styles', 'print_emoji_styles' );
remove_action('admin_print_styles', 'print_emoji_styles' );  

?>
