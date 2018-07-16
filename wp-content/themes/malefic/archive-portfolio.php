<?php 
	get_header();
	get_template_part('inc/content-section', 'open');
	get_template_part('loop/loop-portfolio', get_option('portfolio_layout', 'grid'));
	get_template_part('inc/content-section', 'close');
	get_footer();