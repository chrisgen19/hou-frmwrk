<?php

/*-------------------------------------------------------------------------------------

TABLE OF CONTENTS

- MENUS : WordPress 3.0 New Features Support

-------------------------------------------------------------------------------------*/



/*-----------------------------------------------------------------------------------*/
/* MENUS : WordPress 3.0 New Features Support */
/*-----------------------------------------------------------------------------------*/

if ( function_exists('wp_nav_menu') ) {
	add_theme_support( 'nav-menus' );
	register_nav_menus( array( 'primary-menu' => __( 'Primary Menu', 'woothemes' ) ) );
}

?>