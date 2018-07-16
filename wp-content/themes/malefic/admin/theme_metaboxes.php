<?php 

/**
 * Build theme metaboxes
 * Uses the cmb metaboxes class found in the ebor framework plugin
 * More details here: https://github.com/WebDevStudios/Custom-Metaboxes-and-Fields-for-WordPress
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
if(!( function_exists('ebor_custom_metaboxes') )){
	function ebor_custom_metaboxes( $meta_boxes ) {
		$prefix = '_ebor_';
		
		$social_options = array_values(ebor_get_icons());
		foreach( $social_options as $social_option ){
			$final_social_options[$social_option] = $social_option;
		}
		
		$footer_options = ebor_get_footer_layouts();
		$footer_overrides['none'] = 'Do Not Override Footer Option On This Page';
		foreach( $footer_options as $key => $value ){
			$footer_overrides[$key] = 'Override Footer: ' . $value; 	
		}
		
		$header_options = ebor_get_header_layouts();
		$header_overrides['none'] = 'Do Not Override Header Option On This Page';
		foreach( $header_options as $key => $value ){
			$header_overrides[$key] = 'Override Header: ' . $value; 	
		}

		$meta_boxes[] = array(
			'id' => 'portfolio_layout_metabox',
			'title' => esc_html__('Portfolio Item Layout Options', 'malefic'),
			'object_types' => array('portfolio'), // post type
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => 'Featured Content Type',
					'id' => $prefix . 'featured_content_type',
					'type' => 'select',
					'options' => array(
						'slider' => 'Image Slider',
						'tiles'  => 'Image Tiles',
						'images' => 'Image Feed',
						'video'  => 'Video'
					),
					'default' => 'slider',
					'description' => 'What will your featured content be?'
				),
				array(
					'name' => 'Featured Content Position',
					'id' => $prefix . 'portfolio_layout',
					'type' => 'select',
					'options' => array(
						'feature-top' => 'Top',
						'feature-right' => 'Right',
						'feature-bottom' => 'Bottom',
						'feature-left' => 'Left'
					),
					'default' => 'feature-left',
					'description' => 'Where will you show the featured content? Post content will be relative to this.'
				),
				array(
					'name' => esc_html__('Featured Content Images', 'malefic' ),
					'desc' => esc_html__('Min Height 550px, Max 1400px, Drag & Drop to Reorder', 'malefic' ),
					'id' => $prefix . 'gallery_images',
					'type' => 'file_list',
				),
				array(
					'name' => esc_html__('Video Featured Content oEmbed', 'malefic' ),
					'desc' => 'Enter a Youtube or Vimeo URL. Supports services listed <a href="http://codex.wordpress.org/Embeds" target="_blank">here</a>',
					'id'   => $prefix . 'the_oembed',
					'type' => 'oembed',
				),
				array(
					'name' => esc_html__('Video Featured Content oEmbed', 'malefic' ),
					'desc' => 'Enter a Youtube or Vimeo URL. Supports services listed <a href="http://codex.wordpress.org/Embeds" target="_blank">here</a>',
					'id'   => $prefix . 'the_oembed',
					'type' => 'oembed',
				),
				array(
				    'id'          => $prefix . 'meta_repeat_group',
				    'type'        => 'group',
				    'description' => esc_html__( 'Meta Titles & Descriptions', 'malefic' ),
				    'options'     => array(
				        'add_button'    => esc_html__( 'Add Another Entry', 'malefic' ),
				        'remove_button' => esc_html__( 'Remove Entry', 'malefic' ),
				        'sortable'      => true, // beta
				    ),
				    'fields'      => array(
						array(
							'name' => esc_html__('Additional Item Title', 'malefic'),
							'desc' => esc_html__("Title of your Additional Meta", 'malefic'),
							'id'   => $prefix . 'the_additional_title',
							'type' => 'text'
						),
						array(
							'name' => esc_html__('Additional Item Detail', 'malefic'),
							'desc' => esc_html__("Detail of your Additional Meta", 'malefic'),
							'id'   => $prefix . 'the_additional_detail',
							'type' => 'textarea_code'
						),
				    ),
				),
				array(
					'name' => esc_html__('Additional Content to Display Below Post Meta', 'malefic' ),
					'id'   => $prefix . 'meta_wysiwyg',
					'type' => 'wysiwyg',
				),
			)
		);
		
		/**
		 * testimonial options
		 */
		$meta_boxes[] = array(
			'id' => 'testimonial_metabox',
			'title' => esc_html__('Testimonial Details', 'malefic'),
			'object_types' => array('testimonial'), // post type
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => esc_html__('Job Title', 'malefic'),
					'desc' => '(Optional) Enter a Job Title for this testimonial',
					'id'   => $prefix . 'the_job_title',
					'type' => 'text',
				),
			),
		);
		
		/**
		 * Social Icons for Team Members
		 */
		$meta_boxes[] = array(
			'id' => 'team_social_metabox',
			'title' => esc_html__('Team Member Details', 'malefic'),
			'object_types' => array('team'), // post type
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => esc_html__('Job Title', 'malefic'),
					'desc' => '(Optional) Enter a Job Title for this Team Member',
					'id'   => $prefix . 'the_job_title',
					'type' => 'text',
				),
				array(
				    'id'          => $prefix . 'team_social_icons',
				    'type'        => 'group',
				    'options'     => array(
				        'add_button'    => esc_html__( 'Add Another Icon', 'malefic' ),
				        'remove_button' => esc_html__( 'Remove Icon', 'malefic' ),
				        'sortable'      => true
				    ),
				    'fields' => array(
						array(
							'name' => 'Social Icon',
							'desc' => 'What icon would you like for this team members first social profile?',
							'id' => $prefix . 'social_icon',
							'type' => 'select',
							'options' => $final_social_options
						),
						array(
							'name' => esc_html__('URL for Social Icon', 'malefic'),
							'desc' => esc_html__("Enter the URL for Social Icon 1 e.g www.google.com", 'malefic'),
							'id'   => $prefix . 'social_icon_url',
							'type' => 'text_url',
						),
				    ),
				),
			)
		);
		
		$custom_menus = array();
		$custom_menus['none'] = 'Do Not Override Menu On This Page';
		$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
		if ( is_array( $menus ) && ! empty( $menus ) ) {
			foreach ( $menus as $single_menu ) {
				if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->slug ) ) {
					$custom_menus[ $single_menu->slug ] = $single_menu->name;
				}
			}
		}
		
		/**
		 * Post & Portfolio Header Images
		 */
		$meta_boxes[] = array(
			'id' => 'post_header_metabox',
			'title' => esc_html__('Page Overrides', 'malefic'),
			'object_types' => array('page', 'post', 'team', 'portfolio'), // post type
			'context' => 'normal',
			'priority' => 'low',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name'         => esc_html__( 'Override Header?', 'malefic' ),
					'desc'         => esc_html__( 'Header Layout is set in "appearance" -> "customise". To override this for this page only, use this control.', 'malefic' ),
					'id'           => $prefix . 'header_override',
					'type'         => 'select',
					'options'      => $header_overrides,
					'default'      => 'none'
				),
				array(
					'name'         => esc_html__( 'Override Footer?', 'malefic' ),
					'desc'         => esc_html__( 'Footer Layout is set in "appearance" -> "customise". To override this for this page only, use this control.', 'malefic' ),
					'id'           => $prefix . 'footer_override',
					'type'         => 'select',
					'options'      => $footer_overrides,
					'default'      => 'none'
				),
				array(
				    'name'             => 'Override the menu on this page?',
				    'desc'             => 'Use this option to set a specific menu for this page only.',
				    'id'               => $prefix . 'menu_override',
				    'type'             => 'select',
				    'show_option_none' => true,
				    'default'          => 'none',
				    'options'          => $custom_menus,
				),
			)
		);
				
		return $meta_boxes;
	}
	add_filter( 'cmb2_meta_boxes', 'ebor_custom_metaboxes' );
}