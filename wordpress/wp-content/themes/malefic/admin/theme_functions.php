<?php 

/**
 * HEX to RGB Converter
 *
 * Converts a HEX input to an RGB array.
 * @param $hex - the inputted HEX code, can be full or shorthand, #ffffff or #fff
 * @since 1.0.0
 * @return string
 * @author tommusrhodus
 */
if(!( function_exists('ebor_hex2rgb') )){
	function ebor_hex2rgb($hex) {
	   $hex = str_replace("#", "", $hex);
	
	   if(strlen($hex) == 3) {
	      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
	      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
	      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
	      $r = hexdec(substr($hex,0,2));
	      $g = hexdec(substr($hex,2,2));
	      $b = hexdec(substr($hex,4,2));
	   }
	   $rgb = array($r, $g, $b);
	   return implode(",", $rgb); // returns the rgb values separated by commas
	   return $rgb; // returns an array with the rgb values
	}
}

/**
 * CMB2 Helper Function
 */
if(!( function_exists('ebor_get_wysiwyg_output') )){
	function ebor_get_wysiwyg_output( $meta_key, $post_id = 0 ) {
		global $wp_embed;
	
		$post_id = $post_id ? $post_id : get_the_id();
	
		$content = get_post_meta( $post_id, $meta_key, 1 );
		$content = $wp_embed->autoembed( $content );
		$content = $wp_embed->run_shortcode( $content );
		$content = wpautop( $content );
		$content = do_shortcode( $content );
	
		return $content;
	}
}

if(!( function_exists('ebor_get_blog_layouts') )){
	function ebor_get_blog_layouts(){
		$options = array(
			'Grid & Sidebar' => 'grid-sidebar',
			'List & Sidebar' => 'list-sidebar',
			'Classic & Sidebar' => 'classic-sidebar',
			'Grid' => 'grid',
			'List' => 'list',
			'Classic' => 'classic'
		);
		return $options;
	}
}

if(!( function_exists('ebor_get_portfolio_layouts') )){
	function ebor_get_portfolio_layouts(){
		$options = array(
			'Content Portfolio'  => 'grid',
			'Lightbox Portfolio' => 'lightbox'
		);
		return $options;
	}
}

/**
 * Returns an array of all available header layouts
 * 
 * @val array
 * @since 1.0.0
 * @package Foundry
 * @author TommusRhodus
 */
if(!( function_exists('ebor_get_header_layouts') )){
	function ebor_get_header_layouts(){
		$options = array(
			'blank' => 'No Navigation',
			'1' => 'Standard Navigation',
			'2' => 'Overlay Navigation'
		);
		return $options;	
	}
}

if(!( function_exists('ebor_get_footer_layouts') )){
	function ebor_get_footer_layouts(){
		$options = array(
			'blank' => 'No Footer',
			'1' => 'Short Footer',
			'2' => 'Widgets Footer',
			'3' => 'Centered Footer'
		);
		return $options;	
	}
}

/**
 * Init theme options
 * Certain theme options need to be written to the database as soon as the theme is installed.
 * This is either for the enqueues in ebor-framework, or to override the default image sizes in WooCommerce.
 * Either way this function is only called when the theme is first activated, de-activating and re-activating the theme will result in these options returning to defaults.
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
if(!( function_exists('ebor_init_theme_options') )){
	
	/**
	 * Hook in on activation
	 */
	global $pagenow;
	
	/**
	 * Define image sizes
	 */
	function ebor_init_theme_options() {
		
		//Set all options to zero before initialising options for this theme
		$existing_options = get_option('ebor_framework_options');
		if( is_array($existing_options) ){
			foreach ($existing_options as $key => $value) {
				$existing_options[$key] = '0';
			}
			update_option('ebor_framework_options', $existing_options);
		}
		
		//Ebor Framework
		$framework_args = array(
			'portfolio_post_type'   => '1',
			'team_post_type'        => '1',
			'client_post_type'      => '0',
			'testimonial_post_type' => '1',
			'case_study_post_type'  => '0',
			'service_post_type'     => '0',
			'career_post_type'      => '0',
			'mega_menu'             => '0',
			'aq_resizer'            => '0',
			'page_builder'          => '0',
			'likes'                 => '0',
			'options'               => '1',
			'metaboxes'             => '0',
			'pivot_shortcodes'      => '0',
			'foundry_shortcodes'    => '0',
			'foundry_widgets'       => '0',
			'pillar_vc_shortcodes'  => '0',
			'malefic_vc_shortcodes' => '1',
			'elemis_shortcodes'     => '1',
			'malefic_widgets'       => '1'
		);
		update_option('ebor_framework_options', $framework_args);
		
	}
	
	/**
	 * Only call this action when we first activate the theme.
	 */
	if ( 
		is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ||
		is_admin() && isset( $_GET['theme'] ) && $pagenow == 'customize.php'
	){
		add_action( 'after_setup_theme', 'ebor_init_theme_options', 1 );
	}
	
}

/**
 * Register the required plugins for this theme.
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
if(!( function_exists('ebor_register_required_plugins') )){
	function ebor_register_required_plugins() {
		$plugins = array(
			array(
			    'name'      => esc_html__('Contact Form 7', 'malefic'),
			    'slug'      => 'contact-form-7',
			    'required'  => false,
			    'version' 	=> '3.7.2'
			),
			array(
			    'name'      => esc_html__('Custom Metaboxes 2', 'malefic'),
			    'slug'      => 'cmb2',
			    'required'  => true,
			    'version' 	=> '1.0.0'
			),
			array(
			    'name'      => esc_html__('One Click Demo Import', 'malefic'),
			    'slug'      => 'one-click-demo-import',
			    'required'  => false,
			    'version' 	=> '1.0.0'
			),
			array(
			    'name'      => esc_html__('WP Less','malefic'),
			    'slug'      => 'wp-less',
			    'required'  => true,
			    'version' 	=> '1.0.0'
			),
			array(
				'name'     				=> esc_html__('Ebor Framework', 'malefic'),
				'slug'     				=> 'Ebor-Framework-master',
				'source'   				=> 'https://github.com/tommusrhodus/ebor-framework/archive/master.zip',
				'required' 				=> true,
				'version' 				=> '1.3.5',
				'external_url' 			=> 'https://github.com/tommusrhodus/ebor-framework/archive/master.zip',
			),
			array(
				'name'     				=> esc_html__('Visual Composer', 'malefic'),
				'slug'     				=> 'js_composer',
				'source'   				=> 'http://www.madeinebor.com/plugin-downloads/js_composer-latest.zip',
				'required' 				=> false,
				'external_url' 			=> 'http://www.madeinebor.com/plugin-downloads/js_composer-latest.zip',
				'version' 				=> '5.1.1',
			),
			array(
				'name'     				=> esc_html__('Revolution Slider','malefic'),
				'slug'     				=> 'revslider',
				'source'   				=> 'http://www.madeinebor.com/plugin-downloads/revslider-latest.zip',
				'required' 				=> false,
				'external_url' 			=> 'http://www.madeinebor.com/plugin-downloads/revslider-latest.zip',
				'version'               => '5.1.6'
			),
		);
		$config = array(
			'is_automatic' => true,
		);
		tgmpa( $plugins, $config );
	}
	add_action( 'tgmpa_register', 'ebor_register_required_plugins' );
}

/**
 * ebor_get_footer_layout
 * 
 * Use to conditionally check the page footer meta layout against the theme option for the same
 * In short, this function can override the global footer option on a post by post basis
 * Call within get_footer() for this to override the global footer choice
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
if(!( function_exists('ebor_get_footer_layout') )){
	function ebor_get_footer_layout(){
		global $post;
		
		if(!( isset($post->ID) ))
			return get_option('footer_layout', '3');
			
		$footer = get_post_meta($post->ID, '_ebor_footer_override', 1);
		if( '' == $footer || false == $footer || 'none' == $footer ){
			$footer = get_option('footer_layout', '3');
		}
		
		return $footer;	
	}
}

/**
 * ebor_get_header_layout
 * 
 * Use to conditionally check the page header meta layout against the theme option for the same
 * In short, this function can override the global header option on a post by post basis
 * Call within get_header() for this to override the global header choice
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
if(!( function_exists('ebor_get_header_layout') )){
	function ebor_get_header_layout(){
		global $post;
		
		if( is_search() || !( isset($post->ID) ) )
			return get_option('header_layout', '1');
		
		$header = get_post_meta($post->ID, '_ebor_header_override', 1);
		if( '' == $header || false == $header || 'none' == $header ){
			$header = get_option('header_layout', '1');
		}
		
		return $header;	
	}
}

/**
 * Add additional styling options to TinyMCE
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
if(!( function_exists('ebor_mce_buttons_2') )){
	function ebor_mce_buttons_2( $buttons ) {
	    array_unshift( $buttons, 'styleselect' );
	    return $buttons;
	}
	add_filter( 'mce_buttons_2', 'ebor_mce_buttons_2' );
}

/**
 * Add additional styling options to TinyMCE
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
if(!( function_exists('ebor_mce_before_init') )){
	function ebor_mce_before_init( $settings ) {
	    $style_formats = array(
	    	array(
	    		'title'	=> 'Button Styles',
	    		'items'	=> array(
	    	    	array(
	    	    		'title' => 'A: Button',
	    	    		'selector' => 'a',
	    	    		'classes' => 'btn',
	    	    	)
	    		)
	    	),
	    	array(
	    		'title'	=> 'Text Styles',
	    		'items'	=> array(
	    	    	array(
	    	    		'title' => 'P: Lead Paragraph',
	    	    		'selector' => 'p',
	    	    		'classes' => 'lead',
	    	    	),
	    	    	array(
	    	    		'title' => 'H2: Section Title',
	    	    		'selector' => 'h2',
	    	    		'classes' => 'section-title',
	    	    	),
	    		)
	    	),
	    	array(
	    		'title'	=> 'List Styles',
	    		'items'	=> array(
	    	    	array(
	    	    		'title' => 'UL: Small Dots',
	    	    		'selector' => 'ul',
	    	    		'classes' => 'unordered-list',
	    	    	),
	    	    	array(
	    	    		'title' => 'UL: Big Dots',
	    	    		'selector' => 'ul',
	    	    		'classes' => 'unordered-list-disc',
	    	    	),
	    	    	array(
	    	    		'title' => 'UL: Circle Dots',
	    	    		'selector' => 'ul',
	    	    		'classes' => 'unordered-list-circle',
	    	    	),
	    	    	array(
	    	    		'title' => 'OL: Numbered',
	    	    		'selector' => 'ol',
	    	    		'classes' => 'ordered-list-number',
	    	    	),
	    	    	array(
	    	    		'title' => 'OL: Numerals',
	    	    		'selector' => 'ol',
	    	    		'classes' => 'ordered-list-roman',
	    	    	),
	    	    	array(
	    	    		'title' => 'OL: Lettered',
	    	    		'selector' => 'ol',
	    	    		'classes' => 'ordered-list-alpha',
	    	    	)
	    		)
	    	)
	    );
	    $settings['style_formats'] = json_encode( $style_formats );
	    return $settings;
	}
	add_filter( 'tiny_mce_before_init', 'ebor_mce_before_init' );
}

if(!( function_exists('ebor_load_more') )){
	function ebor_load_more($pages = '', $range = 2){
		$showitems = ($range * 2)+1;
		
		global $paged;
		if(empty($paged)) $paged = 1;
		
		if($pages == ''){
			global $wp_query;
			$pages = $wp_query->max_num_pages;
				if(!$pages) {
					$pages = 1;
				}
		}
		
		$output = '<div id="js-single-more" class="text-center">';
		
		if(1 !== $pages){
			for ($i=1; $i <= $pages; $i++){
				
				$protocol = is_ssl() ? 'https' : 'http';
				$current_url = esc_url("$protocol://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
				$url = trailingslashit($current_url) . 'page/' . $i;
				
				$output .= ($paged == $i)? "":"<a href='". $url ."' class='cbp-l-loadMore-link btn'><span class='cbp-l-loadMore-defaultText'>". esc_html__('LOAD MORE', 'malefic') ."</span><span class='cbp-l-loadMore-loadingText'>". esc_html__('LOADING...', 'malefic') ."</span><span class='cbp-l-loadMore-noMoreLoading'>". esc_html__('NO MORE WORKS', 'malefic') ."</span></a>";
				
			}
		}
		
		$output .= '</div>';

		return $output;
	}
}

function ebor_get_icons(){
	return array("fa-500px","fa-address-book","fa-address-book-o","fa-address-card","fa-address-card-o","fa-adjust","fa-adn","fa-align-center","fa-align-justify","fa-align-left","fa-align-right","fa-amazon","fa-ambulance","fa-american-sign-language-interpreting","fa-anchor","fa-android","fa-angellist","fa-angle-double-down","fa-angle-double-left","fa-angle-double-right","fa-angle-double-up","fa-angle-down","fa-angle-left","fa-angle-right","fa-angle-up","fa-apple","fa-archive","fa-area-chart","fa-arrow-circle-down","fa-arrow-circle-left","fa-arrow-circle-o-down","fa-arrow-circle-o-left","fa-arrow-circle-o-right","fa-arrow-circle-o-up","fa-arrow-circle-right","fa-arrow-circle-up","fa-arrow-down","fa-arrow-left","fa-arrow-right","fa-arrow-up","fa-arrows","fa-arrows-alt","fa-arrows-h","fa-arrows-v","fa-assistive-listening-systems","fa-asterisk","fa-at","fa-audio-description","fa-backward","fa-balance-scale","fa-ban","fa-bandcamp","fa-bar-chart","fa-barcode","fa-bars","fa-bath","fa-battery-empty","fa-battery-full","fa-battery-half","fa-battery-quarter","fa-battery-three-quarters","fa-bed","fa-beer","fa-behance","fa-behance-square","fa-bell","fa-bell-o","fa-bell-slash","fa-bell-slash-o","fa-bicycle","fa-binoculars","fa-birthday-cake","fa-bitbucket","fa-bitbucket-square","fa-black-tie","fa-blind","fa-bluetooth","fa-bluetooth-b","fa-bold","fa-bolt","fa-bomb","fa-book","fa-bookmark","fa-bookmark-o","fa-braille","fa-briefcase","fa-btc","fa-bug","fa-building","fa-building-o","fa-bullhorn","fa-bullseye","fa-bus","fa-buysellads","fa-calculator","fa-calendar","fa-calendar-check-o","fa-calendar-minus-o","fa-calendar-o","fa-calendar-plus-o","fa-calendar-times-o","fa-camera","fa-camera-retro","fa-car","fa-caret-down","fa-caret-left","fa-caret-right","fa-caret-square-o-down","fa-caret-square-o-left","fa-caret-square-o-right","fa-caret-square-o-up","fa-caret-up","fa-cart-arrow-down","fa-cart-plus","fa-cc","fa-cc-amex","fa-cc-diners-club","fa-cc-discover","fa-cc-jcb","fa-cc-mastercard","fa-cc-paypal","fa-cc-stripe","fa-cc-visa","fa-certificate","fa-chain-broken","fa-check","fa-check-circle","fa-check-circle-o","fa-check-square","fa-check-square-o","fa-chevron-circle-down","fa-chevron-circle-left","fa-chevron-circle-right","fa-chevron-circle-up","fa-chevron-down","fa-chevron-left","fa-chevron-right","fa-chevron-up","fa-child","fa-chrome","fa-circle","fa-circle-o","fa-circle-o-notch","fa-circle-thin","fa-clipboard","fa-clock-o","fa-clone","fa-cloud","fa-cloud-download","fa-cloud-upload","fa-code","fa-code-fork","fa-codepen","fa-codiepie","fa-coffee","fa-cog","fa-cogs","fa-columns","fa-comment","fa-comment-o","fa-commenting","fa-commenting-o","fa-comments","fa-comments-o","fa-compass","fa-compress","fa-connectdevelop","fa-contao","fa-copyright","fa-creative-commons","fa-credit-card","fa-credit-card-alt","fa-crop","fa-crosshairs","fa-css3","fa-cube","fa-cubes","fa-cutlery","fa-dashcube","fa-database","fa-deaf","fa-delicious","fa-desktop","fa-deviantart","fa-diamond","fa-digg","fa-dot-circle-o","fa-download","fa-dribbble","fa-dropbox","fa-drupal","fa-edge","fa-eercast","fa-eject","fa-ellipsis-h","fa-ellipsis-v","fa-empire","fa-envelope","fa-envelope-o","fa-envelope-open","fa-envelope-open-o","fa-envelope-square","fa-envira","fa-eraser","fa-etsy","fa-eur","fa-exchange","fa-exclamation","fa-exclamation-circle","fa-exclamation-triangle","fa-expand","fa-expeditedssl","fa-external-link","fa-external-link-square","fa-eye","fa-eye-slash","fa-eyedropper","fa-facebook","fa-facebook-official","fa-facebook-square","fa-fast-backward","fa-fast-forward","fa-fax","fa-female","fa-fighter-jet","fa-file","fa-file-archive-o","fa-file-audio-o","fa-file-code-o","fa-file-excel-o","fa-file-image-o","fa-file-o","fa-file-pdf-o","fa-file-powerpoint-o","fa-file-text","fa-file-text-o","fa-file-video-o","fa-file-word-o","fa-files-o","fa-film","fa-filter","fa-fire","fa-fire-extinguisher","fa-firefox","fa-first-order","fa-flag","fa-flag-checkered","fa-flag-o","fa-flask","fa-flickr","fa-floppy-o","fa-folder","fa-folder-o","fa-folder-open","fa-folder-open-o","fa-font","fa-font-awesome","fa-fonticons","fa-fort-awesome","fa-forumbee","fa-forward","fa-foursquare","fa-free-code-camp","fa-frown-o","fa-futbol-o","fa-gamepad","fa-gavel","fa-gbp","fa-genderless","fa-get-pocket","fa-gg","fa-gg-circle","fa-gift","fa-git","fa-git-square","fa-github","fa-github-alt","fa-github-square","fa-gitlab","fa-glass","fa-glide","fa-glide-g","fa-globe","fa-google","fa-google-plus","fa-google-plus-official","fa-google-plus-square","fa-google-wallet","fa-graduation-cap","fa-gratipay","fa-grav","fa-h-square","fa-hacker-news","fa-hand-lizard-o","fa-hand-o-down","fa-hand-o-left","fa-hand-o-right","fa-hand-o-up","fa-hand-paper-o","fa-hand-peace-o","fa-hand-pointer-o","fa-hand-rock-o","fa-hand-scissors-o","fa-hand-spock-o","fa-handshake-o","fa-hashtag","fa-hdd-o","fa-header","fa-headphones","fa-heart","fa-heart-o","fa-heartbeat","fa-history","fa-home","fa-hospital-o","fa-hourglass","fa-hourglass-end","fa-hourglass-half","fa-hourglass-o","fa-hourglass-start","fa-houzz","fa-html5","fa-i-cursor","fa-id-badge","fa-id-card","fa-id-card-o","fa-ils","fa-imdb","fa-inbox","fa-indent","fa-industry","fa-info","fa-info-circle","fa-inr","fa-instagram","fa-internet-explorer","fa-ioxhost","fa-italic","fa-joomla","fa-jpy","fa-jsfiddle","fa-key","fa-keyboard-o","fa-krw","fa-language","fa-laptop","fa-lastfm","fa-lastfm-square","fa-leaf","fa-leanpub","fa-lemon-o","fa-level-down","fa-level-up","fa-life-ring","fa-lightbulb-o","fa-line-chart","fa-link","fa-linkedin","fa-linkedin-square","fa-linode","fa-linux","fa-list","fa-list-alt","fa-list-ol","fa-list-ul","fa-location-arrow","fa-lock","fa-long-arrow-down","fa-long-arrow-left","fa-long-arrow-right","fa-long-arrow-up","fa-low-vision","fa-magic","fa-magnet","fa-male","fa-map","fa-map-marker","fa-map-o","fa-map-pin","fa-map-signs","fa-mars","fa-mars-double","fa-mars-stroke","fa-mars-stroke-h","fa-mars-stroke-v","fa-maxcdn","fa-meanpath","fa-medium","fa-medkit","fa-meetup","fa-meh-o","fa-mercury","fa-microchip","fa-microphone","fa-microphone-slash","fa-minus","fa-minus-circle","fa-minus-square","fa-minus-square-o","fa-mixcloud","fa-mobile","fa-modx","fa-money","fa-moon-o","fa-motorcycle","fa-mouse-pointer","fa-music","fa-neuter","fa-newspaper-o","fa-object-group","fa-object-ungroup","fa-odnoklassniki","fa-odnoklassniki-square","fa-opencart","fa-openid","fa-opera","fa-optin-monster","fa-outdent","fa-pagelines","fa-paint-brush","fa-paper-plane","fa-paper-plane-o","fa-paperclip","fa-paragraph","fa-pause","fa-pause-circle","fa-pause-circle-o","fa-paw","fa-paypal","fa-pencil","fa-pencil-square","fa-pencil-square-o","fa-percent","fa-phone","fa-phone-square","fa-picture-o","fa-pie-chart","fa-pied-piper","fa-pied-piper-alt","fa-pied-piper-pp","fa-pinterest","fa-pinterest-p","fa-pinterest-square","fa-plane","fa-play","fa-play-circle","fa-play-circle-o","fa-plug","fa-plus","fa-plus-circle","fa-plus-square","fa-plus-square-o","fa-podcast","fa-power-off","fa-print","fa-product-hunt","fa-puzzle-piece","fa-qq","fa-qrcode","fa-question","fa-question-circle","fa-question-circle-o","fa-quora","fa-quote-left","fa-quote-right","fa-random","fa-ravelry","fa-rebel","fa-recycle","fa-reddit","fa-reddit-alien","fa-reddit-square","fa-refresh","fa-registered","fa-renren","fa-repeat","fa-reply","fa-reply-all","fa-retweet","fa-road","fa-rocket","fa-rss","fa-rss-square","fa-rub","fa-safari","fa-scissors","fa-scribd","fa-search","fa-search-minus","fa-search-plus","fa-sellsy","fa-server","fa-share","fa-share-alt","fa-share-alt-square","fa-share-square","fa-share-square-o","fa-shield","fa-ship","fa-shirtsinbulk","fa-shopping-bag","fa-shopping-basket","fa-shopping-cart","fa-shower","fa-sign-in","fa-sign-language","fa-sign-out","fa-signal","fa-simplybuilt","fa-sitemap","fa-skyatlas","fa-skype","fa-slack","fa-sliders","fa-slideshare","fa-smile-o","fa-snapchat","fa-snapchat-ghost","fa-snapchat-square","fa-snowflake-o","fa-sort","fa-sort-alpha-asc","fa-sort-alpha-desc","fa-sort-amount-asc","fa-sort-amount-desc","fa-sort-asc","fa-sort-desc","fa-sort-numeric-asc","fa-sort-numeric-desc","fa-soundcloud","fa-space-shuttle","fa-spinner","fa-spoon","fa-spotify","fa-square","fa-square-o","fa-malefic-exchange","fa-malefic-overflow","fa-star","fa-star-half","fa-star-half-o","fa-star-o","fa-steam","fa-steam-square","fa-step-backward","fa-step-forward","fa-stethoscope","fa-sticky-note","fa-sticky-note-o","fa-stop","fa-stop-circle","fa-stop-circle-o","fa-street-view","fa-strikethrough","fa-stumbleupon","fa-stumbleupon-circle","fa-subscript","fa-subway","fa-suitcase","fa-sun-o","fa-superpowers","fa-superscript","fa-table","fa-tablet","fa-tachometer","fa-tag","fa-tags","fa-tasks","fa-taxi","fa-telegram","fa-television","fa-tencent-weibo","fa-terminal","fa-text-height","fa-text-width","fa-th","fa-th-large","fa-th-list","fa-themeisle","fa-thermometer-empty","fa-thermometer-full","fa-thermometer-half","fa-thermometer-quarter","fa-thermometer-three-quarters","fa-thumb-tack","fa-thumbs-down","fa-thumbs-o-down","fa-thumbs-o-up","fa-thumbs-up","fa-ticket","fa-times","fa-times-circle","fa-times-circle-o","fa-tint","fa-toggle-off","fa-toggle-on","fa-trademark","fa-train","fa-transgender","fa-transgender-alt","fa-trash","fa-trash-o","fa-tree","fa-trello","fa-tripadvisor","fa-trophy","fa-truck","fa-try","fa-tty","fa-tumblr","fa-tumblr-square","fa-twitch","fa-twitter","fa-twitter-square","fa-umbrella","fa-underline","fa-undo","fa-universal-access","fa-university","fa-unlock","fa-unlock-alt","fa-upload","fa-usb","fa-usd","fa-user","fa-user-circle","fa-user-circle-o","fa-user-md","fa-user-o","fa-user-plus","fa-user-secret","fa-user-times","fa-users","fa-venus","fa-venus-double","fa-venus-mars","fa-viacoin","fa-viadeo","fa-viadeo-square","fa-video-camera","fa-vimeo","fa-vimeo-square","fa-vine","fa-vk","fa-volume-control-phone","fa-volume-down","fa-volume-off","fa-volume-up","fa-weibo","fa-weixin","fa-whatsapp","fa-wheelchair","fa-wheelchair-alt","fa-wifi","fa-wikipedia-w","fa-window-close","fa-window-close-o","fa-window-maximize","fa-window-minimize","fa-window-restore","fa-windows","fa-wordpress","fa-wpbeginner","fa-wpexplorer","fa-wpforms","fa-wrench","fa-xing","fa-xing-square","fa-y-combinator","fa-yahoo","fa-yelp","fa-yoast","fa-youtube","fa-youtube-play","fa-youtube-square", "budicon-pie-chart","budicon-coffee","budicon-location-1","budicon-cocktail","budicon-noodle","budicon-drop","budicon-book","budicon-leaf","budicon-fork-knife","budicon-fire","budicon-meal","budicon-fridge","budicon-microwave","budicon-shop","budicon-receipt","budicon-receipt-1","budicon-diamond","budicon-tie","budicon-cash-dollar","budicon-cash-euro","budicon-cash-pound","budicon-cash-yen","budicon-tshirt","budicon-bag","budicon-shirt","budicon-tag","budicon-wallet","budicon-coins","budicon-cash","budicon-pack","budicon-gift","budicon-shopping-bag","budicon-shopping-cart","budicon-shopping-cart-1","budicon-sun","budicon-cloud","budicon-album","budicon-note-1","budicon-note","budicon-repeat","budicon-list","budicon-eject","budicon-forward","budicon-backward","budicon-stop","budicon-pause","budicon-pause-1","budicon-play","budicon-equalizer","budicon-volume","budicon-volume-1","budicon-volume-2","budicon-speaker","budicon-speaker-1","budicon-mic","budicon-radio","budicon-calculator","budicon-binoculars","budicon-scissors","budicon-hammer","budicon-compass","budicon-ruler","budicon-headphones","budicon-umbrella","budicon-tv-1","budicon-video","budicon-gameboy","budicon-joystick","budicon-mouse","budicon-monitor","budicon-mobile","budicon-disk","budicon-search","budicon-camera","budicon-camera-2","budicon-camera-1","budicon-magnet","budicon-magic-wand","budicon-redo","budicon-undo","budicon-brush","budicon-bookmark","budicon-trash","budicon-trash-1","budicon-pencil-1","budicon-pencil-2","budicon-pencil-3","budicon-pencil-4","budicon-book-1","budicon-lock","budicon-authors","budicon-author","budicon-setting","budicon-wrench","budicon-share","budicon-code","budicon-link","budicon-link-1","budicon-alert","budicon-download","budicon-upload","budicon-server","budicon-webcam","budicon-graph","budicon-rss","budicon-statistic","budicon-browser-2","budicon-browser-3","budicon-browser-4","budicon-browser-5","budicon-browser","budicon-network","budicon-cone","budicon-location","budicon-grid","budicon-cancel-2","budicon-check-2","budicon-minus-2","budicon-plus-2","budicon-layout","budicon-grid-1","budicon-layout-1","budicon-layout-2","budicon-layout-3","budicon-layout-4","budicon-layout-5","budicon-layout-6","budicon-layout-7","budicon-layout-8","budicon-layout-9","budicon-layout-10","budicon-cancel","budicon-check-1","budicon-plus-1","budicon-minus-1","budicon-enlarge","budicon-fullscreen","budicon-fullscreen-2","budicon-fullscreen-1","budicon-enlarge-1","budicon-list-1","budicon-arrow-diagonal","budicon-arrow-diagonal-1","budicon-arrow-vertical","budicon-arrow-horizontal","budicon-date","budicon-power","budicon-cloud-upload","budicon-cloud-download","budicon-glass","budicon-home","budicon-download-1","budicon-upload-1","budicon-window","budicon-fullscreen-3","budicon-arrow","budicon-arrow-1","budicon-arrow-2","budicon-arrow-3","budicon-arrow-down","budicon-arrow-right","budicon-arrow-up","budicon-arrow-left","budicon-target","budicon-target-1","budicon-star","budicon-heart","budicon-check","budicon-cancel-1","budicon-minus","budicon-plus","budicon-crop","budicon-bell","budicon-search-1","budicon-search-2","budicon-search-5","budicon-search-4","budicon-search-3","budicon-clock","budicon-dashboard","budicon-check-3","budicon-cancel-3","budicon-minus-3","budicon-plus-3","budicon-support","budicon-arrow-left-bottom","budicon-arrow-right-bottom","budicon-arrow-right-top","budicon-arrow-left-top","budicon-arrow-down-1","budicon-arrow-right-1","budicon-arrow-up-1","budicon-arrow-left-1","budicon-link-external","budicon-link-incoming","budicon-aid-kit","budicon-lab","budicon-flag","budicon-award","budicon-award-1","budicon-award-2","budicon-timer","budicon-tv","budicon-mic-1","budicon-bicycle","budicon-bus","budicon-car","budicon-direction","budicon-leaf-1","budicon-bulb","budicon-tree","budicon-home-1","budicon-pin","budicon-clock-1","budicon-date-2","budicon-timer-1","budicon-clock-2","budicon-time","budicon-clock-3","budicon-date-1","budicon-map","budicon-pin-1","budicon-compass-1","budicon-crown","budicon-pointer","budicon-pointer-1","budicon-pointer-2","budicon-puzzle","budicon-gender-female","budicon-gender-male","budicon-globe","budicon-cube","budicon-book-2","budicon-notebook","budicon-image","budicon-image-1","budicon-image-2","budicon-image-3","budicon-camera-3","budicon-camera-4","budicon-video-1","budicon-briefcase","budicon-briefcase-1","budicon-document","budicon-document-1","budicon-document-2","budicon-document-3","budicon-paper","budicon-note-2","budicon-note-3","budicon-note-5","budicon-attachment","budicon-note-4","budicon-note-6","budicon-note-7","budicon-note-8","budicon-list-2","budicon-presentation","budicon-presentation-1","budicon-pie-cart","budicon-document-4","budicon-book-3","budicon-note-9","budicon-note-10","budicon-radion","budicon-box","budicon-video-2","budicon-glasses","budicon-box-1","budicon-printer","budicon-printer-1","budicon-pin-2","budicon-pin-3","budicon-folder","budicon-book-4","budicon-cancel-4","budicon-check-4","budicon-minus-4","budicon-plus-4","budicon-equal","budicon-book-5","budicon-book-6","budicon-newspaper","budicon-image-4","budicon-telephone","budicon-mic-2","budicon-paper-plane","budicon-pen","budicon-profile","budicon-mail","budicon-mail-1","budicon-megaphone","budicon-comment","budicon-comment-1","budicon-comment-2","budicon-comment-3","budicon-comment-4","budicon-comment-5");
}

/**
 * Custom Comment Markup for malefic
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
if(!( function_exists('ebor_custom_comment') )){
	function ebor_custom_comment($comment, $args, $depth) { 
		$GLOBALS['comment'] = $comment; 
	?>
		
		<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
		    <div class="message">
			    <div class="user"><?php echo get_avatar( $comment->comment_author_email, 70 ); ?></div>
			    <div class="message-inner">
			        <div class="info">
			          <?php printf('<h5>%s</h5>', get_comment_author_link()); ?>
			          <div class="meta">
			          	<span class="date"><?php echo get_comment_date(); ?></span>
			          	<span class="reply"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?></span>
			          </div>
			        </div>
			        <?php echo wpautop( htmlspecialchars_decode( get_comment_text() ) ); ?>
			        <?php if ($comment->comment_approved == '0') : ?>
			        <p><em><?php esc_html_e('Your comment is awaiting moderation.', 'malefic') ?></em></p>
			        <?php endif; ?>
			    </div>
		    </div>
		
	<?php }
}
