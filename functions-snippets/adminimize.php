/*

-
ADMINIMIZE

Remove a bunch of admin stuff from user roles that don't need it.
Reduce user confusion and overload. Let them focus on the tasks that are important to them.

*/

$user = wp_get_current_user();
$allowed_roles = array( 'editor', 'administrator', 'author' );
if ( array_intersect( $allowed_roles, $user->roles ) ) {
   // Stuff here for allowed roles
}


add_action( 'admin_init', 'gdq_remove_menu_pages' );
function gdq_remove_menu_pages() {
    global $user_ID;
    if ( current_user_can( 'editor' ) ) {
//        remove_menu_page( 'authorhreview' );
//        remove_menu_page( 'edit.php'); // Posts
//        remove_menu_page( 'upload.php'); // Media
//        remove_menu_page( 'link-manager.php'); // Links
        remove_menu_page( 'edit-comments.php'); // Comments (remove to clean up dashboard when not using comments)
//        remove_menu_page( 'edit.php?post_type=page'); // Pages
//        remove_menu_page( 'plugins.php'); // Plugins
//        remove_menu_page( 'themes.php'); // Appearance
//        remove_menu_page( 'users.php'); // Users
        remove_menu_page( 'tools.php'); // Tools
//        remove_menu_page( 'options-general.php'); // Settings
//        remove_menu_page( 'admin.php?page=pb_backupbuddy_backup' ); // BackupBuddy
//        remove_menu_page( 'admin.php?page=itsec-dashboard' ); // iThemes Security
//        remove_menu_page( 'edit.php?post_type=acf-field-group' ); // ACF

    } elseif (current_user_can ( 'contributor' ) ) {
        remove_menu_page( 'edit-comments.php'); // Comments (remove to clean up dashboard when not using comments)
        remove_menu_page( 'admin.php?page=acf-options' ); // Options from ACF
        remove_menu_page( 'tools.php'); // Tools
        remove_menu_page( 'edit.php' ); // Posts
        remove_menu_page( 'edit.php?post_type=ctla_job_board' ); // CTLA Job Board
    }
}

/*
 *  Hide the Admin Bar for user roles less than Editor
 */
if ( ! current_user_can( 'edit_pages' ) ) {
    add_filter( 'show_admin_bar', '__return_false' );
}
