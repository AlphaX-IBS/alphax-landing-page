<?php 
	get_header();
	the_post();
	
	get_template_part('inc/content-section', 'open');
?>

<div class="blog row">
	<div class="col-sm-8 col-sm-offset-2 classic-view">
	
		<div class="blog-content">
			<div class="blog-posts">
				<div class="post">
				
					<?php 
						if( 'yes' == get_option('show_single_team_title', 'yes') )
							the_title('<h1 class="post-title text-center">', '</h1>'); 
						
						if( 'yes' == get_option('show_single_team_thumbnail', 'yes') )	
							get_template_part('inc/content-single-post', 'thumbnail');
					?>
					
					<div class="post-content">
						<?php 
							the_content();
							wp_link_pages();

							if( 'yes' == get_option('show_single_team_sharing', 'yes') )	
								get_template_part('inc/content-single-post', 'sharing');
						?>
					</div><!-- /.post-content --> 
				
				</div><!-- /.post --> 
			</div><!-- /.blog-posts --> 
		</div><!-- /.blog-content -->
		
		<?php  
			if( 'yes' == get_option('show_single_team_navigation', 'yes') )
				get_template_part('inc/content-single-post', 'navigation');
		?>
		
	</div><!-- /.blog-content -->
</div><!-- /.blog --> 

<?php 
	get_template_part('inc/content-section', 'close');
	
	get_footer();