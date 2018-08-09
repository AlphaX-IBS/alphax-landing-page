<?php 
	get_header();
	the_post();

	get_template_part('inc/content-section', 'open');
	
	$layout = get_post_meta($post->ID, '_ebor_portfolio_layout', 1);
	if( '' == $layout || false == $layout || !(isset($layout)) ){
		$layout = 'feature-left';
	}
		
	get_template_part('inc/layout-single-portfolio', $layout);
	
	get_template_part('inc/content-section', 'close');
	
	get_footer();