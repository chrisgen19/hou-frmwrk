<?php

$includes = array(
				'includes/init.php', 			// Options panel settings and custom settings
				'includes/post-types.php', 			// Options panel settings and custom settings
				);

// Allow child themes/plugins to add widgets to be loaded.
$includes = apply_filters( 'hrzn_includes', $includes );
			
foreach ( $includes as $i ) {
	locate_template( $i, true );
}







/*-----------------------------------------------------------------------------------*/
/* WooSEO Deprecation Banner */
/*-----------------------------------------------------------------------------------*/

if ( is_admin() && current_user_can( 'install_plugins' ) && isset( $_GET['page'] ) && ( $_GET['page'] == 'woothemes' || $_GET['page'] == 'woothemes_framework_settings' ) ) {
	add_action( 'wooframework_container_inside', 'hrzn_banner' );
	add_action( 'wooframework_wooframeworksettings_container_inside', 'hrzn_banner' );
}

/**
 * Add a WooSEO Deprecation banner on the WooSEO Options screen.
 * @since 5.4.0
 * @return void
 */
function hrzn_banner () {
	if ( get_user_setting( 'wooframeworkhidebannerwooseosbmremoved', '0' ) == '1' ) { return; }

	$close_url = wp_nonce_url( admin_url( 'admin-ajax.php?action=wooframework_banner_close&banner=wooseosbmremoved' ), 'wooframework_banner_close' );
	$html = '';
	
	$html .= '<div id="presstrends-banner" class="wooframework-banner">' . "\n";
	$html .= '<span class="main">' . __( 'Welcome to Hourizon Framework.', 'woothemes' ) . '</span>' . "\n";
	$html .= '<span>' . sprintf( __( 'For your SEO needs, we encourage you to use the %1$s.', 'woothemes' ), '<a href="' . esc_url( 'http://wordpress.org/extend/plugins/wordpress-seo/' ) . '" title="' . esc_attr__( 'Get WordPress SEO', 'woothemes' ) . '" target="_blank">' . __( 'WordPress SEO Plugin', 'woothemes' ) . '</a>' ) . '</span><span>' . __( 'If you need help moving your existing SEO data, WordPress SEO has a built-in importer to move your data over.', 'woothemes' ) . '</span>' . "\n";
	$html .= '<br /><br /><span>' . sprintf( __( 'While the Sidebar Manager has been removed, we encourage you to download %1$s in our free plugin, %2$s. There is also a Sidebar Manager to WooSidebars Converter plugin, available through WooDojo.', 'woothemes' ), '<a href="' . esc_url( 'http://www.woothemes.com/woosidebars/' ) . '" title="' . esc_attr__( 'Get WooSidebars', 'woothemes' ) . '" target="_blank">' . __( 'WooSidebars', 'woothemes' ) . '</a>', '<a href="' . esc_url( 'http://www.woothemes.com/woodojo/' ) . '" title="' . esc_attr__( 'Get WooDojo', 'woothemes' ) . '" target="_blank">' . __( 'WooDojo', 'woothemes' ) . '</a>' ) . '</span>' . "\n";
	$html .= '<span class="close-banner"><a href="' . $close_url . '">' . __( 'Close', 'woothemes' ) . '</a></span>' . "\n";
	$html .= '</div>' . "\n";
	
	echo $html;
} // End hrzn_banner()

?>