<div class="blog row">

	<div class="col-sm-8 classic-view">
	
		<div class="blog-content">
			<div class="blog-posts">
				<?php 
					if ( have_posts() ) : while ( have_posts() ) : the_post();
						/**
						 * Get blog posts by blog layout.
						 */
						get_template_part('loop/content-post', 'classic-sidebar');
					
					endwhile;	
					else : 
						
						/**
						 * Display no posts message if none are found.
						 */
						get_template_part('loop/content','none');
						
					endif;
				?>
			</div><!-- /.blog-posts --> 
		</div><!-- /.blog-content -->
		
		<?php get_template_part('inc/content', 'pagination'); ?>
	
	</div><!-- /.blog-content -->
	
	<?php get_sidebar(); ?>

</div><!-- /.blog --> 