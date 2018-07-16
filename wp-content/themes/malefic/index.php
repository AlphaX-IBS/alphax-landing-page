<?php 
	get_header();
	get_template_part('inc/content-section', 'open');
	get_template_part('loop/loop-post', get_option('blog_layout', 'grid-sidebar'));
	get_template_part('inc/content-section', 'close');
	get_footer();