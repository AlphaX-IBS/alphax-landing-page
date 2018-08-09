<div class="item">
	<blockquote>
		<?php the_content(); ?>
		<div class="author">
			<?php the_title('<h5>', '</h5><div class="meta">'. get_post_meta($post->ID, '_ebor_the_job_title', 1) .'</div>'); ?>
		</div>
	</blockquote>
</div><!-- /.item -->