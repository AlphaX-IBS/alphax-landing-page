<div id="post-<?php the_id(); ?>" <?php post_class('post col-sm-12 col-md-4 equal-height'); ?>>
	
	<?php if( has_post_thumbnail() ) : ?>
		<figure class="overlay">
			<a href="<?php the_permalink(); ?>">
				<span class="over">
					<span><?php esc_html_e('View Post', 'malefic'); ?></span>
				</span>
				<?php the_post_thumbnail('large'); ?>
			</a>
		</figure>
	<?php endif; ?>
	
	<div class="post-content">
	
		<div class="meta">
			<span class="date"><?php the_time(get_option('date_format')); ?></span>
			<span class="category"><?php the_category(', '); ?></span>
		</div>
		
		<?php 
			the_title('<h2 class="post-title"><a href="'. get_permalink() .'">', '</a></h2>'); 
			the_excerpt();
		?>
		
		<a href="<?php the_permalink(); ?>" class="more"><?php esc_html_e('Read More', 'malefic'); ?></a> 
		
	</div><!-- /.post-content --> 

</div><!-- /.post -->