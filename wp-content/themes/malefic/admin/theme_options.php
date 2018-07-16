<?php 

function ebor_set_transport($wp_customize){	
	
	//Single post meta
	$wp_customize->selective_refresh->add_partial( 'malefic_single_post_title', array(
	    'selector' => '.single .article__title h1'
	) );

}
add_action('customize_register', 'ebor_set_transport', 20 );


/**
 * Build theme options
 * Uses the Ebor_Options class found in the ebor-framework plugin
 * Panels are WP 4.0+!!!
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
if( class_exists('Ebor_Options') ){
	
	$social_options = array_values(ebor_get_icons());
	$ebor_options = new Ebor_Options;
	$theme = wp_get_theme();
	$theme_name = $theme->get( 'Name' );
	$footer_layouts = ebor_get_footer_layouts();
	$blog_layouts = array_flip(ebor_get_blog_layouts());

	foreach( $social_options as $social_option ){
		$final_social_options[$social_option] = str_replace('fa-', '', $social_option);
	}
	
	$ebor_options->add_panel( $theme_name . ': Header Settings', 215, 'All of the controls in this section directly relate to the header and logos of ' . $theme_name);
	
	//Header Settings
	$ebor_options->add_section('logo_settings_section', 'Logo Settings', 10, $theme_name . ': Header Settings');
	
	//Logo Options
	$ebor_options->add_setting('image', 'malefic_logo', 'Logo', 'logo_settings_section', EBOR_THEME_DIRECTORY . 'style/images/logo.png', 5);
	
	//Team options
	$ebor_options->add_panel( $theme_name . ': Team Settings', 215, 'All of the controls in this section directly relate to team area of ' . $theme_name);
	$ebor_options->add_section('team_title_section', 'Team Options', 320, $theme_name . ': Team Settings');
	$ebor_options->add_setting('input', 'team_title', 'Team Title', 'team_title_section', 'Meet the Team', 10);
	$ebor_options->add_setting('textarea', 'team_subtitle', 'Team Subtitle', 'team_title_section', 'Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Nulla vitae elit libero, a pharetra augue.', 15);
	
	//Colours
	$ebor_options->add_setting('color', 'colour_text', 'Text Colour', 'colors', '#606060', 5);
	$ebor_options->add_setting('color', 'colour_headings', 'Headings Colour', 'colors', '#303030', 10);
	$ebor_options->add_setting('color', 'colour_highlight', 'Highlight Colour', 'colors', '#5ebcc1', 15);
	$ebor_options->add_setting('color', 'colour_meta', 'Meta Colour', 'colors', '#808080', 25);
	$ebor_options->add_setting('color', 'colour_white', 'White Colour', 'colors', '#ffffff', 35);
	$ebor_options->add_setting('color', 'colour_grey', 'Grey Colour', 'colors', '#dddddd', 40);
	$ebor_options->add_setting('color', 'colour_darkgrey', 'Dark Grey Colour', 'colors', '#909090', 45);
	$ebor_options->add_setting('color', 'colour_nav', 'Nav Colour', 'colors', '#cccccc', 50);
	$ebor_options->add_setting('color', 'colour_navbackground', 'Nav Background Colour', 'colors', '#2a2a2a', 52);
	$ebor_options->add_setting('color', 'colour_subfooter', 'Subfooter Background Colour', 'colors', '#2a2a2a', 55);
	
	//Blog Settings
	$ebor_options->add_panel( $theme_name . ': Blog Settings', 215, 'All of the controls in this section directly relate to blog area of ' . $theme_name);
	$ebor_options->add_section('blog_layout_section', 'Blog Layout', 310,  $theme_name . ': Blog Settings');
	$ebor_options->add_setting('select', 'blog_layout', 'Blog Archives Layout', 'blog_layout_section', 'grid-sidebar', 10, $blog_layouts);
	
	$ebor_options->add_panel( $theme_name . ': Footer Settings', 245, 'All of the controls in this section directly relate to the control of footer design within ' . $theme_name);
	$ebor_options->add_section('footer_social_settings_section', 'Footer Social Settings', 20, $theme_name . ': Footer Settings');
	
	$ebor_options->add_section('footer_settings_section', 'Footer Settings', 30, $theme_name . ': Footer Settings');
	$ebor_options->add_setting('select', 'footer_layout', 'Global Footer Layout', 'footer_settings_section', '3', 5, $footer_layouts);
	
	//Footer Icons
	for( $i = 1; $i < 6; $i++ ){
		$ebor_options->add_setting('select', 'footer_social_icon_' . $i, 'Footer Social Icon ' . $i, 'footer_social_settings_section', 'none', 20 + $i + $i, $final_social_options);
		$ebor_options->add_setting('input', 'footer_social_url_' . $i, 'Footer Social URL ' . $i, 'footer_social_settings_section', '', 21 + $i + $i);
	}
	
	$ebor_options->add_setting('textarea', 'footer_copyright', 'Copyright Message', 'footer_settings_section', '© 2017 Malefic. All rights reserved. Theme by tommusrhodus.', 20);
	
}