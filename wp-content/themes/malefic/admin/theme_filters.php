<?php 

/**
 * CE Menu per page plugin equivalent
 */
if(!( function_exists('ebor_override_menu') )){
	function ebor_override_menu($args = ''){
		global $post;
	
		if( isset($post->ID) ){
			$override = get_post_meta($post->ID, '_ebor_menu_override', 1);
			if(!( 'none' ==  $override || false == $override || '' == $override )){
				if( is_nav_menu($override) ){
					$args['menu'] = $override;
				}	
			}
		}
		
		return $args;
			
	}
	add_filter('wp_nav_menu_args', 'ebor_override_menu', 99);
}

if(!( function_exists('ebor_single_oembed_result') )){
	function ebor_single_oembed_result($html, $url, $args) {
		global $post;

		if( strpos($html, 'youtube') !== false || strpos($html, 'vimeo') !== false ){
			$html = str_replace('<iframe', '<iframe class="embed-responsive-item"', $html);
			$html = '<figure class="embed-responsive embed-responsive-16by9">'. $html .'</figure>';
		}
		
	    return $html;
	}
	add_filter('embed_oembed_html','ebor_single_oembed_result', 10, 3);
}

if(!( function_exists('ebor_excerpt_length') )){
	function ebor_excerpt_length( $length ) {
		return 15;
	}
	add_filter( 'excerpt_length', 'ebor_excerpt_length', 999 );
}

if(!( function_exists('ebor_egf_force_styles') )){ 
	function ebor_egf_force_styles( $force_styles ) {
	    return true;
	}
	add_filter( 'tt_font_force_styles', 'ebor_egf_force_styles' );
}

/**
 * Add a clearfix to the end of the_content()
 */
if(!( function_exists('ebor_add_clearfix') )){ 
	function ebor_add_clearfix( $content ) { 
		if( is_single() )
	   		$content = $content .= '<div class="clearfix"></div>';
	    return $content;
	}
	add_filter( 'the_content', 'ebor_add_clearfix' ); 
}

if(!( function_exists('ebor_excerpt_more') )){
	function ebor_excerpt_more( $more ) {
		return '...';
	}
	add_filter('excerpt_more', 'ebor_excerpt_more');
}

if(!( function_exists('ebor_tag_cloud') )){	
	function ebor_tag_cloud($string){
	   return preg_replace("/style='font-size:.+pt;'/", '', $string);
	}
	add_filter('wp_generate_tag_cloud', 'ebor_tag_cloud',10,1);
}

/**
 * Remove leading whitespace from the_excerpt
 */
if(!( function_exists('ebor_ltrim_excerpt') )){
	function ebor_ltrim_excerpt( $excerpt ) {
	    return preg_replace( '~^(\s*(?:&nbsp;)?)*~i', '', $excerpt );
	}
	add_filter( 'get_the_excerpt', 'ebor_ltrim_excerpt' );
}

function ebor_modify_read_more_link() {
    return '<a class="more-link more text-center" href="' . get_permalink() . '">'. esc_html__('Read More', 'malefic') .'</a>';
}
add_filter( 'the_content_more_link', 'ebor_modify_read_more_link' );

if( class_exists('OCDI_Plugin') ){
	
	function ebor_ocdi_plugin_intro_text( $default_text ) {
	    $default_text .= '
	    	<div class="ocdi__intro-text">
	    		<h3>Read this before importing demo data!</h3>
	    		<p>We have prepared full written & video documentation to make your life with malefic much more easy. It is worth spending a few minutes with this to familiarise yourself with the theme & its plugins before jumping in with your demo data, so <a href="https://tommusrhodus.ticksy.com/articles/100007405?print" target="_blank">please read the theme documentation</a> before importing the demo data.</p>
	    		<hr />
	    	</div>
	    ';
	
	    return $default_text;
	}
	add_filter( 'pt-ocdi/plugin_intro_text', 'ebor_ocdi_plugin_intro_text' );
	
	function ebor_ocdi_confirmation_dialog_options ( $options ) {
	    return array_merge( $options, array(
	        'width'       => 600,
	        'dialogClass' => 'wp-dialog',
	        'resizable'   => false,
	        'height'      => 'auto',
	        'modal'       => true,
	    ) );
	}
	add_filter( 'pt-ocdi/confirmation_dialog_options', 'ebor_ocdi_confirmation_dialog_options', 10, 1 );
	
	//Setup basic demo import
	function ebor_import_files() {
		
		$theme = wp_get_theme();
		
		$import_notice_vc = '
			<h3>Ready to Import Malefic + Visual Composer Demo Data</h3>
			<p>Please ensure all required plugins in "appearance => install plugins" are installed before running this demo importer.</p>
			<p>Since you\'re importing Malefic + Visual Composer Demo Data, please ensure Visual Composer is enabled in "plugins".</p>
			<p>You will need to install sample Revolution Sliders manually <strong>please see the documentation!</strong></p>
			<p><a href="https://tommusrhodus.ticksy.com/articles/100007405?print" target="_blank">Please read the theme documentation.</a></p>
		';
				
	    return array(
	        array(
	            'import_file_name'             => 'Malefic 1',
	            'import_file_url'              => 'http://tommusdemos.wpengine.com/theme-assets/malefic/demo-data.xml',
	            'import_widget_file_url'       => 'http://tommusdemos.wpengine.com/theme-assets/malefic/widgets.wie',
	            'import_customizer_file_url'   => 'http://tommusdemos.wpengine.com/theme-assets/malefic/options.dat',
	            'import_preview_image_url'     => esc_url($theme->get_screenshot()),
	            'import_notice'                => $import_notice_vc,
	        ),
	        array(
	            'import_file_name'             => 'Malefic 2',
	            'import_file_url'              => 'http://tommusdemos.wpengine.com/theme-assets/malefic/demo-data-2.xml',
	            'import_widget_file_url'       => 'http://tommusdemos.wpengine.com/theme-assets/malefic/widgets-2.wie',
	            'import_customizer_file_url'   => 'http://tommusdemos.wpengine.com/theme-assets/malefic/options-2.dat',
	            'import_preview_image_url'     => esc_url($theme->get_screenshot()),
	            'import_notice'                => $import_notice_vc,
	        )
	    );
	    
	}
	add_filter( 'pt-ocdi/import_files', 'ebor_import_files' );
	
	//Setup front page and menus
	function ebor_after_import_setup() {
		
	    // Assign menus to their locations.
	    $main_menu = get_term_by( 'name', 'Standard Navigation', 'nav_menu' );

	    set_theme_mod( 'nav_menu_locations', array(
	            'primary'  => $main_menu->term_id,
	        )
	    );
	
	    // Assign front page and posts page (blog page).
	    $front_page_id = get_page_by_title( 'Home 1' );
	    $blog_page_id  = get_page_by_title( 'Blog' );
	
	    update_option( 'show_on_front', 'page' );
	    update_option( 'page_on_front', $front_page_id->ID );
	    update_option( 'page_for_posts', $blog_page_id->ID );
	
	}
	add_action( 'pt-ocdi/after_import', 'ebor_after_import_setup' );
	
	//Remove Branding
	add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
	
	//Save customize options
	add_action( 'pt-ocdi/enable_wp_customize_save_hooks', '__return_true' );
	
	//Stop thumbnail generation
	add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );
	
}

/**
 * Add additional settings to gallery shortcode
 */
if(!( function_exists('ebor_add_gallery_settings') )){ 
	function ebor_add_gallery_settings(){
?>
	
		<script type="text/html" id="tmpl-malefic-gallery-setting">
			<h3>Malefic Theme Gallery Settings</h3>
			<label class="setting">
				<span><?php esc_html_e('Gallery Layout', 'malefic'); ?></span>
				<select data-setting="layout">
					<option value="default">Default Layout</option>     
					<option value="tiles">Malefic Tiles</option>
				</select>
			</label>
		</script>
	
		<script>
			jQuery(document).ready(function(){
				jQuery.extend(wp.media.gallery.defaults, { layout: 'default' });
				
				wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
					template: function(view){
					  return wp.media.template('gallery-settings')(view)
					       + wp.media.template('malefic-gallery-setting')(view);
					}
				});
			});
		</script>
	  
<?php
	}
	add_action('print_media_templates', 'ebor_add_gallery_settings');
}


/**
 * Custom gallery shortcode
 *
 * Filters the standard WordPress gallery shortcode.
 *
 * @since 1.0.0
 */
if(!( function_exists('ebor_post_gallery') )){
	function ebor_post_gallery( $output, $attr) {
		
		global $post, $wp_locale;
	
	    static $instance = 0;
	    $instance++;
	
	    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	    if ( isset( $attr['orderby'] ) ) {
	        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
	        if ( !$attr['orderby'] )
	            unset( $attr['orderby'] );
	    }
	
	    extract(shortcode_atts(array(
	        'order'      => 'ASC',
	        'orderby'    => 'menu_order ID',
	        'id'         => $post->ID,
	        'itemtag'    => 'div',
	        'icontag'    => 'dt',
	        'captiontag' => 'dd',
	        'columns'    => 3,
	        'size'       => 'large',
	        'include'    => '',
	        'exclude'    => '',
	        'layout'     => ''
	    ), $attr));
	
	    $id = intval($id);
	    if ( 'RAND' == $order )
	        $orderby = 'none';
	
	    if ( !empty($include) ) {
	        $include = preg_replace( '/[^0-9,]+/', '', $include );
	        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	
	        $attachments = array();
	        foreach ( $_attachments as $key => $val ) {
	            $attachments[$val->ID] = $_attachments[$key];
	        }
	    } elseif ( !empty($exclude) ) {
	        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
	        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	    } else {
	        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	    }
	
	    if ( empty($attachments) )
	        return '';
	
	    if ( is_feed() ) {
	        $output = "\n";
	        foreach ( $attachments as $att_id => $attachment )
	            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
	        return $output;
	    }

	    /**
	     * Return Slider Layout
	     */
	    if( $layout == 'tiles' ){

	    	$output = '<div class="tiles post-gallery"><div class="items row row-offset-0 light-gallery">';
	    		
			$i = 0;
			foreach( $attachments as $id => $content ){
				$i++;
				$src = wp_get_attachment_image_src($id, 'full');
				$class = (!( $i % 3 == 0 )) ? 'col-xs-12 col-sm-6 col-md-6' : 'col-xs-12 col-sm-12 col-md-12';
				$attachment = get_post($id);

			
				$output .= '
					<div class="item cbp-caption-active cbp-caption-fadeIn '. esc_attr($class) .'">
					
						<figure>
							<a href="'. esc_url($src[0]) .'" data-rel="lightcase:post" class="lgitem cbp-caption" data-sub-html="#caption'. esc_attr($i) .'">
								'. wp_get_attachment_image($id, 'large') .'
								<div class="cbp-caption-activeWrap">
									<div class="cbp-l-caption-alignCenter">
										<div class="cbp-l-caption-body">
											<p>'. esc_html($attachment->post_title) .'</p>
										</div>
									</div>
								</div>
							</a>
						</figure>
						
						<div id="caption'. esc_attr($i) .'" class="hidden">
							<h3>'. esc_html($attachment->post_title) .'</h3>
							<p>'. esc_html($attachment->post_excerpt) .'</p>
						</div>
					
					</div><!--/.item -->
				';
				
			}
	    		
	    	$output .= '</div><!--/.items --> </div><!--/.tiles --><div class="space20"></div>';
	    	
	    	return $output;
	    	
	    }
	    
	}
	add_filter( 'post_gallery', 'ebor_post_gallery', 10, 2 );
}