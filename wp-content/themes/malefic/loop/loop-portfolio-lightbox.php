<div id="js-lightbox-filter" class="cbp-filter-container text-center">
	<div data-filter="*" class="cbp-filter-item-active cbp-filter-item"><?php esc_html_e('All', 'malefic'); ?></div>
	<?php
		$cats = get_categories('taxonomy=portfolio_category');
		
		if(is_array($cats)){
			foreach($cats as $cat){
				echo '<div data-filter=".'. esc_attr($cat->slug) .'" class="cbp-filter-item"> '. $cat->name .' </div> ';
			}
		}
	?>
</div>

<div class="clearfix"></div>

<div class="space20"></div>

<div id="js-grid-lightbox" class="cbp cbp-l-grid-inline light-gallery">
	<?php 
		if ( have_posts() ) : while ( have_posts() ) : the_post();
		
			/**
			 * Get blog posts by blog layout.
			 */
			get_template_part('loop/content-portfolio', 'lightbox');
		
		endwhile;	
		else : 
			
			/**
			 * Display no posts message if none are found.
			 */
			get_template_part('loop/content','none');
			
		endif;
	?>
</div>

<div class="space30"></div>

<?php echo ebor_load_more(); ?>