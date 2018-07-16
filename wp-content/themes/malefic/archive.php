<?php 
	get_header();
	get_template_part('inc/content-section', 'open');
	
	$term = get_queried_object();
?>
	
	<h1 class="section-title text-center"><?php echo esc_html__('Posts In: ','malefic') . $term->name; ?></h1>
	<p class="text-center"><?php echo esc_html(strip_tags($term->description)); ?></p>
	<hr />
	
<?php
	get_template_part('loop/loop-post', get_option('blog_layout', 'grid-sidebar'));
	get_template_part('inc/content-section', 'close');
	get_footer();