<?php 
	$icons = get_post_meta( $post->ID, '_ebor_team_social_icons', true );
	$protocols = array(  'http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet', 'skype' );
?>

<div class="item">

	<figure class="mb-20">
		<?php the_post_thumbnail('large'); ?>
	</figure>
	
	<?php the_title('<h5><a href="'. get_permalink() .'">', '</a></h5><div class="meta">'. get_post_meta($post->ID, '_ebor_the_job_title', 1) .'</div>'); ?>
	<div class="space5"></div>
	
	<?php the_excerpt(); ?>
	
	<?php if( is_array($icons) ) : ?>
		<ul class="social">
			<?php 
				foreach( $icons as $key => $icon ){
					if(!( isset( $icon['_ebor_social_icon_url'] ) ))
						continue;
						
					echo '<li><a href="'. esc_url($icon['_ebor_social_icon_url'], $protocols) .'" target="_blank"><i class="fa '. esc_attr($icon['_ebor_social_icon']) .'"></i></a></li>';
				}
			?>
		</ul>
	<?php endif; ?>
	
</div><!-- /.item -->