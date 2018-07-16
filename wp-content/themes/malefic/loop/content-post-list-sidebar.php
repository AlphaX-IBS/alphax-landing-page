<div id="post-<?php the_id(); ?>" <?php post_class('post row'); ?>>
	
	<?php if( has_post_thumbnail() ) : ?>
		<div class="col-md-5">
			<figure class="overlay">
				<a href="<?php the_permalink(); ?>">
					<span class="over">
						<span><?php esc_html_e('View Post', 'malefic'); ?></span>
					</span>
					<?php the_post_thumbnail('large'); ?>
				</a>
			</figure>
		</div>
	<?php endif; ?>
	
	<div class="col-md-7">
		<div class="post-content text-left">
		
			<?php 
				get_template_part('inc/content-single-post', 'meta'); 
				the_title('<h3 class="post-title"><a href="'. get_permalink() .'">', '</a></h3>');
				the_excerpt();
			?>

			<a href="<?php the_permalink(); ?>" class="more"><?php esc_html_e('Read More', 'malefic'); ?></a> 
		
		</div><!-- /.post-content --> 
	</div><!-- /column --> 

</div><!-- /.post -->