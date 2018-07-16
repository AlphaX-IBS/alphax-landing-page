<?php 
	get_header();
	the_post();
	
	get_template_part('inc/content-section', 'open');
?>

<div class="blog row">

	<div class="col-sm-8 classic-view">
	
		<div class="blog-content">
			<div class="blog-posts">
				<div class="post">
				
					<?php 
						if( 'yes' == get_option('show_single_post_meta', 'yes') )
							get_template_part('inc/content-single-post', 'meta');
						
						if( 'yes' == get_option('show_single_post_title', 'yes') )
							the_title('<h1 class="post-title text-center">', '</h1>'); 
						
						if( 'yes' == get_option('show_single_post_thumbnail', 'no') )	
							get_template_part('inc/content-single-post', 'thumbnail');
					?>
					
					<div class="post-content">
						<?php 
							the_content();
							wp_link_pages();
							
							if( 'yes' == get_option('show_single_post_tags', 'yes') )
								the_tags('<div class="meta tags text-center">', ', ', '</div>'); 
							
							if( 'yes' == get_option('show_single_post_sharing', 'yes') )	
								get_template_part('inc/content-single-post', 'sharing');
						?>
					</div><!-- /.post-content --> 
				
				</div><!-- /.post --> 
			</div><!-- /.blog-posts --> 
		</div><!-- /.blog-content -->
		
		<?php
			if( 'yes' == get_option('show_single_post_navigation', 'yes') )
				get_template_part('inc/content-single-post', 'navigation');
				
			if( 'yes' == get_option('show_single_post_author', 'yes') )
				get_template_part('inc/content-single-post', 'author');
				
			if( comments_open() || get_comments_number() )
				comments_template();
		?>
	  
	</div><!-- /.blog-content -->
	
	<?php get_sidebar(); ?>

</div><!-- /.blog --> 

<?php 
	get_template_part('inc/content-section', 'close');
	
	get_footer();