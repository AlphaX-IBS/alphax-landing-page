<div class="blog row">
	<div class="col-sm-12 list-view">
	
		<div class="blog-content">
			<div class="blog-post">
				<?php 
					if ( have_posts() ) : while ( have_posts() ) : the_post();
						/**
						 * Get blog posts by blog layout.
						 */
						get_template_part('loop/content-post', 'list-sidebar');
					
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
		
		<hr class="pt-0" />
		
		<?php get_template_part('inc/content', 'pagination'); ?>
	
	</div><!-- /.blog-content -->
</div><!-- /.blog --> 