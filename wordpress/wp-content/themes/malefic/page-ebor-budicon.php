<?php 
	get_header();
	the_post();
	
	get_template_part('inc/content-section', 'open');
?>

<img src="<?php echo EBOR_THEME_DIRECTORY; ?>style/images/budicon.jpg" alt="budicons" />

<?php 
	get_template_part('inc/content-section', 'close');
	get_footer();