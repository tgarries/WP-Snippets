/*
* Remove CSS Customizer from WP Admin Area
*/

add_action( 'customize_register', 'jt_customize_register' );
function jt_customize_register( $wp_customize ) {
    $wp_customize->remove_control( 'custom_css' );
}
