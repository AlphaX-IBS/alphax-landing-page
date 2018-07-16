<?php 
	get_header();
	get_template_part('inc/content-section', 'open');
	
	$author = get_user_by( 'slug', get_query_var( 'author_name' ) );
?>
	
	<h1 class="section-title text-center"><?php echo esc_html__('Posts By: ','malefic') . $author->display_name; ?></h1>
	<hr />
	
<?php
	get_template_part('loop/loop-post', get_option('blog_layout', 'grid-sidebar'));
	get_template_part('inc/content-section', 'close');
	get_footer();