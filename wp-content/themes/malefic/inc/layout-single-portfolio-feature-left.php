<div class="row">

	<div class="col-md-8">
		<?php
			$layout = get_post_meta($post->ID, '_ebor_featured_content_type', 1);
			if( '' == $layout || false == $layout || !(isset($layout)) ){
				$layout = 'slider';
			}
			
			get_template_part('inc/content-single-portfolio', $layout);
		?>
	</div><!-- /column -->
	
	<div class="space30 hidden-xs hidden-md hidden-lg"></div>
	
	<aside class="col-md-4 col-sm-12 sidebar post-content">
		<?php 
			the_title('<h1 class="post-title">', '</h1>'); 
			the_content();
			get_template_part('inc/content-single-portfolio', 'post-meta');
		?>
	</aside><!-- /.sidebar --> 

</div><!-- /.row -->