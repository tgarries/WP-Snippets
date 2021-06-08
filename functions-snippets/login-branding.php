/*
Custom Login Branding
*/

add_filter( 'login_headerurl', 'namespace_login_headerurl' );
/**
 * Replaces the login header logo URL
 *
 * @param $url
 */
function namespace_login_headerurl( $url ) {
    $url = home_url( '/' );
    return $url;
}

add_filter( 'login_headertitle', 'namespace_login_headertitle' );
/**
 * Replaces the login header logo title
 *
 * @param $title
 */
function namespace_login_headertitle( $title ) {
    $title = get_bloginfo( 'name' );
    return $title;
}

add_action( 'login_head', 'namespace_login_style' );
/**
 * Replaces the login header logo
 */
function namespace_login_style() {
    echo '<style>.login h1 a { background-image: url( ' . get_template_directory_uri() . '/images/logo.png ) !important; }</style>';
}
