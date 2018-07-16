<?php
	$layout = get_post_meta($post->ID, '_ebor_featured_content_type', 1);
	if( '' == $layout || false == $layout || !(isset($layout)) ){
		$layout = 'slider';
	}
	
	get_template_part('inc/content-single-portfolio', $layout);
?>

<div class="space40"></div>

<?php the_title('<h1 class="post-title">', '</h1>'); ?>

<div class="row">

	<div class="col-sm-8 post-content">
		<?php 
			the_content(); 
			get_template_part('inc/content-single-portfolio', 'button');
		?>
	</div><!-- /column -->
	
	<aside class="col-sm-4 sidebar no-button">
		<?php get_template_part('inc/content-single-portfolio', 'post-meta'); ?>
	</aside><!-- /.sidebar --> 

</div><!-- /.row --> 
