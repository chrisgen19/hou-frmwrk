/*-----------------------------------------------------------------------------------*/
/* Run scripts on jQuery(document).ready() */
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function(){

	// FitVids - Responsive Videos
	jQuery( '.widget, .panel, .video' ).fitVids();
	
	// Add class to parent menu items with JS until WP does this natively
	jQuery( 'ul.sub-menu, ul.children' ).parents( 'li' ).addClass( 'parent' );
	
	// Responsive Navigation (switch top drop down for select)
	jQuery('ul#top-nav').mobileMenu({
	    switchWidth: 767,                   					//width (in px to switch at)
	    topOptionText: woo_localized_data.select_a_page,     	//first option text
	    indentString: '&nbsp;&nbsp;&nbsp;'						//string for indenting nested items
	});
	
	// Show/hide the main navigation
  	jQuery( '.nav-toggle' ).click(function() {
	  jQuery( '#navigation' ).slideToggle( 'fast', function() {
	  	return false;
	    // Animation complete.
	  });
	});
	
	// Stop the navigation link moving to the anchor (Still need the anchor for semantic markup)
	jQuery( '.nav-toggle a' ).click(function(e) {
        e.preventDefault();
    });

/*-----------------------------------------------------------------------------------*/
/* Add rel="lightbox" to image links if the lightbox is enabled */
/*-----------------------------------------------------------------------------------*/

if ( jQuery( 'body' ).hasClass( 'has-lightbox' ) && ! jQuery( 'body' ).hasClass( 'portfolio-component' ) ) {
	jQuery( 'a[href$=".jpg"], a[href$=".jpeg"], a[href$=".gif"], a[href$=".png"]' ).each( function () {
		var imageTitle = '';
		if ( jQuery( this ).next().hasClass( 'wp-caption-text' ) ) {
			imageTitle = jQuery( this ).next().text();
		}
		
		if ( '' != imageTitle ) {
			jQuery( this ).attr( 'title', imageTitle );
		}

		if ( jQuery( this ).parents( '.gallery' ).length ) {
			var galleryID = jQuery( this ).parents( '.gallery' ).attr( 'id' );
			jQuery( this ).attr( 'rel', 'lightbox[' + galleryID + ']' );
		} else {
			jQuery( this ).attr( 'rel', 'lightbox' );
		}
	});
	
	jQuery( 'a[rel^="lightbox"]' ).prettyPhoto({social_tools: false});
}

/*-----------------------------------------------------------------------------------*/
/* Add alt-row styling to tables */
/*-----------------------------------------------------------------------------------*/

	jQuery( '.entry table tr:odd' ).addClass( 'alt-table-row' );
}); // End jQuery()