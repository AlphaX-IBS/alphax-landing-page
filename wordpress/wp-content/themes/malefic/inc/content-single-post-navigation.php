<?php 
	$prev_post = get_adjacent_post(false, '', true);
	$next_post = get_adjacent_post(false, '', false);
	
	if( empty($prev_post) && empty($next_post) ){
		return false;
	}
	
	$type = ucfirst(get_post_type()); 
?>

<hr class="pt-0"/>

<div class="post-nav-wrapper">
	
	<div class="post-nav prev">
		<?php if(!empty($prev_post)) : ?>
			<div class="meta"><i class="budicon-arrow-left-1"></i> <?php esc_html_e('Previous', 'malefic'); ?> <?php echo esc_html($type); ?></div>
			<h4><a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>"><?php echo esc_html($prev_post->post_title); ?></a></h4>
		<?php endif; ?>
	</div>

	<div class="post-nav next">
		<?php if(!empty($next_post)) : ?>
			<div class="meta"><?php esc_html_e('Next', 'malefic'); ?> <?php echo esc_html($type); ?> <i class="budicon-arrow-right-1"></i></div>
			<h4><a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>"><?php echo esc_html($next_post->post_title); ?></a></h4>
		<?php endif; ?>
	</div>

</div><!-- /.post-nav -->