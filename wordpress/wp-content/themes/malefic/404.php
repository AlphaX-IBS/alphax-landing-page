<?php 
	get_header();
	get_template_part('inc/content-section', 'open');
?>
	
	<div class="text-center">
		<h1 class="post-title"><?php esc_html_e('Whoops, 404, content is missing..', 'malefic'); ?></h1>
		<a href="<?php echo esc_url(home_url('/')); ?>" class="btn">&larr; <?php esc_html_e('Homepage', 'malefic'); ?></a>
	</div>

<?php	
	get_template_part('inc/content-section', 'close');
	get_footer();