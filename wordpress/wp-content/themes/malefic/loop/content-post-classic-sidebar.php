<div class="post">

	<?php 
		get_template_part('inc/content-single-post', 'meta');
		the_title('<h2 class="post-title text-center"><a href="'. get_permalink() .'">', '</a></h2>'); 
	?>
	
	<div class="post-content add-image-link" data-js-permalink="<?php the_permalink(); ?>" data-js-view-post="<?php esc_attr_e('View Post', 'malefic'); ?>">
		<?php the_content(); ?>
	</div><!-- /.post-content --> 

</div><!-- /.post -->

<hr class="pt-0" />