<div class="row">

	<div class="col-sm-3">
	
		<h3><?php echo wp_kses_post(get_option('team_title', 'Meet the Team')); ?></h3>
		<?php echo wp_kses_post(wpautop(get_option('team_subtitle', 'Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Nulla vitae elit libero, a pharetra augue.'))); ?>
		
		<div class="text-carousel-controls">
			<div class="btn btn-square prev"><i class="fa fa-angle-left"></i></div>
			<div class="btn btn-square next"><i class="fa fa-angle-right"></i></div>
		</div>
	
	</div>
	
	<div class="col-sm-9">
		<div class="text-carousel text-center cs-hidden">
			<?php 
				if ( have_posts() ) : while ( have_posts() ) : the_post();
					/**
					 * Get blog posts by blog layout.
					 */
					get_template_part('loop/content-team', 'carousel');
				
				endwhile;	
				else : 
					
					/**
					 * Display no posts message if none are found.
					 */
					get_template_part('loop/content','none');
					
				endif;
			?>
		</div><!-- /.text-carousel --> 
	</div>

</div>