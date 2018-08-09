<?php

$videos = get_post_meta( $post->ID, '_ebor_the_oembed', true );

if($videos){
	echo '<figure class="embed-responsive embed-responsive-16by9">' . wp_oembed_get(esc_url($videos)) . '</figure>';
}