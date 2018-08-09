<?php 

/**
 * Here is all the custom colours for the theme.
 * $handle is a reference to the handle used with wp_enqueue_style()
 */	
if (class_exists('WPLessPlugin')){
	
    $less = WPLessPlugin::getInstance();

    $less->setVariables(
    	array(
	        'text'             => get_option('colour_text', '#606060'),
	        'highlight'        => get_option('colour_highlight', '#5ebcc1'),
	        'headings'         => get_option('colour_headings', '#303030'),
	        'meta'             => get_option('colour_meta', '#808080'),
	        'white'            => get_option('colour_white', '#ffffff'),
	        'grey'             => get_option('colour_grey', '#dddddd'),
	        'darkgrey'         => get_option('colour_darkgrey', '#909090'),
	        'nav'              => get_option('colour_nav', '#cccccc'),
	        'navbackground'    => get_option('colour_navbackground', '#2a2a2a'),
	        'subfooter'        => get_option('colour_subfooter', '#2a2a2a')
    	)
    );
    
}

/*
 * Register Fonts
 */
if(!( function_exists('ebor_fonts_url') )){
	function ebor_fonts_url(){
	    $font_url = '';
	    if ( 'off' !== _x( 'on', 'Google font: on or off', 'malefic' ) ) {
	        $font_url = add_query_arg( 'family', urlencode( str_replace('+', ' ', get_option('malefic_google_font_string','Dosis:400,500,600,700&subset=latin-ext')) ), "//fonts.googleapis.com/css" );
	    }
	    return $font_url;
	}
}

/**
 * Ebor Load Scripts
 * Properly Enqueues Scripts & Styles for the theme
 * @since version 1.0
 * @author TommusRhodus
 */ 
if(!( function_exists('ebor_load_scripts') )){
	function ebor_load_scripts() {
			
		//Enqueue Styles
		$extension = ( class_exists('WPLessPlugin') ) ? '.less' : '.css';
		wp_enqueue_style('ebor-google-font', ebor_fonts_url(), array(), '1.0.0' );
		wp_enqueue_style('bootstrap', EBOR_THEME_DIRECTORY . 'style/css/bootstrap.min.css' );
		wp_enqueue_style('ebor-fonts', EBOR_THEME_DIRECTORY . 'style/type/icons.css' );	
		wp_enqueue_style('ebor-plugins', EBOR_THEME_DIRECTORY . 'style/css/plugins.css' );	
		wp_enqueue_style('ebor-theme', EBOR_THEME_DIRECTORY . 'style/css/theme'. $extension );		
		wp_enqueue_style('ebor-style', get_stylesheet_uri() );
		
		//Enqueue Scripts
		wp_enqueue_script('bootstrap', EBOR_THEME_DIRECTORY . 'style/js/bootstrap.min.js', array('jquery'), false, true  );
		wp_enqueue_script('ebor-plugins', EBOR_THEME_DIRECTORY . 'style/js/plugins.js', array('jquery'), false, true  );
		wp_enqueue_script('ebor-scripts', EBOR_THEME_DIRECTORY . 'style/js/scripts.js', array('jquery'), false, true  );
		
		//Enqueue Comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
		$custom_css = "
			.cbp-popup-navigation .cbp-popup-prev:before {
			    content: '". esc_html__('Prev', 'malefic') ."'
			}
			.cbp-popup-navigation .cbp-popup-next:before {
			    content: '". esc_html__('Next', 'malefic') ."'
			}
			.cbp-popup-navigation .cbp-popup-close:before {
			    content: '". esc_html__('Close', 'malefic') ."'
			}
		";
		wp_add_inline_style( 'ebor-style', $custom_css);
		
	}
	add_action('wp_enqueue_scripts', 'ebor_load_scripts', 110);
}

/**
 * Ebor Load Admin Scripts
 * Properly Enqueues Scripts & Styles for the theme
 * 
 * @since version 1.0
 * @author TommusRhodus
 */
if(!( function_exists('ebor_admin_load_scripts') )){
	function ebor_admin_load_scripts(){
		wp_enqueue_style('ebor-theme-admin-css', EBOR_THEME_DIRECTORY . 'admin/ebor-theme-admin.css' );
		wp_enqueue_style('ebor-fonts', EBOR_THEME_DIRECTORY . 'style/type/icons.css' );	
		wp_enqueue_script('ebor-theme-admin-js', EBOR_THEME_DIRECTORY . 'admin/ebor-theme-admin.js', array('jquery'), false, true  );
	}
	add_action('admin_enqueue_scripts', 'ebor_admin_load_scripts', 200);
}