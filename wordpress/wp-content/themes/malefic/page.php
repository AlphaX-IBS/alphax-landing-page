<?php 
	get_header();
	the_post();
	
	get_template_part('inc/content-section', 'open');
?>

<div class="post-content">	
	<?php
		the_title('<h1 class="post-title">', '</h1>');
		the_content();
		wp_link_pages();
	?>
</div>
	
<?php
	get_template_part('inc/content-section', 'close');
	
	get_footer();