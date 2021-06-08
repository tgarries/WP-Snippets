<?php 
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


/*
    Use Site Logo for login page
*/
function namespace_login_style() {
    if( function_exists('get_custom_header') ){
        $width = get_custom_header()->width;
        $height = get_custom_header()->height;
    } else {
        $width = HEADER_IMAGE_WIDTH;
        $height = HEADER_IMAGE_HEIGHT;
    }
    echo '<style>'.PHP_EOL;
    echo '.login h1 a {'.PHP_EOL; 
    echo '  background-image: url( '; header_image(); echo ' ) !important; '.PHP_EOL;
    echo '  width: '.$width.'px !important;'.PHP_EOL;
    echo '  height: '.$height.'px !important;'.PHP_EOL;
    echo '  background-size: '.$width.'px '.$height.'px !important;'.PHP_EOL;
    echo '}'.PHP_EOL;
    echo '</style>'.PHP_EOL;
}
