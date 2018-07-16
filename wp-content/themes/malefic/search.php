<?php 
	get_header();
	get_template_part('inc/content-section', 'open');
	
	global $wp_query;
	$total_results = $wp_query->found_posts;
	$items = ( $total_results == '1' ) ? esc_html__(' Item','malefic') : esc_html__(' Items','malefic');
?>
	
	<h1 class="section-title text-center"><?php echo get_search_query(); ?></h1>
	<p class="text-center"><?php echo esc_html__('Your Search Found ' ,'malefic') . $total_results . $items; ?></p>
	<hr />
	
<?php
	get_template_part('loop/loop-post', get_option('blog_layout', 'grid-sidebar'));
	get_template_part('inc/content-section', 'close');
	get_footer();