<?php 
	$header_images = get_post_meta($post->ID, '_ebor_gallery_images', 1); 
	if( is_array($header_images) ) :
?>

<div class="image-slider">
	<?php 
		foreach( $header_images as $id => $content ){
			echo '<div class="item">' . wp_get_attachment_image($id, 'full') . '</div>';
		}
	?>
</div><!-- /.image-slider -->

<?php endif;