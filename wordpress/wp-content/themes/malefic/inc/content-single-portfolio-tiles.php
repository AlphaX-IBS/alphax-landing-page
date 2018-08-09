<?php 
	$header_images = get_post_meta($post->ID, '_ebor_gallery_images', 1); 
	if( is_array($header_images) ) :
?>

<div class="tiles post-gallery">
	<div class="items row row-offset-0 light-gallery">
		
		<?php 
			$i = 0;
			foreach( $header_images as $id => $content ){
				$i++;
				$src = wp_get_attachment_image_src($id, 'full');
				$class = (!( $i % 3 == 0 )) ? 'col-xs-12 col-sm-6 col-md-6' : 'col-xs-12 col-sm-12 col-md-12';
				$attachment = get_post($id);
			?>
			
				<div class="item cbp-caption-active cbp-caption-fadeIn <?php echo esc_attr($class); ?>">
				
					<figure>
						<a href="<?php echo esc_url($src[0]); ?>" data-rel="lightcase:post" class="lgitem cbp-caption" data-sub-html="#caption<?php echo esc_attr($i); ?>">
							<?php echo wp_get_attachment_image($id, 'large'); ?>
							<div class="cbp-caption-activeWrap">
								<div class="cbp-l-caption-alignCenter">
									<div class="cbp-l-caption-body">
										<p><?php echo esc_html($attachment->post_title); ?></p>
									</div>
								</div>
							</div>
						</a>
					</figure>
					
					<div id="caption<?php echo esc_attr($i); ?>" class="hidden">
						<h3><?php echo esc_html($attachment->post_title); ?></h3>
						<p><?php echo esc_html($attachment->post_excerpt); ?></p>
					</div>
				
				</div><!--/.item -->
				
			<?php
			}
		?>
	
	</div><!--/.items --> 
</div><!--/.tiles -->

<?php endif;