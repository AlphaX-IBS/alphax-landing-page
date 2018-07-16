<div class="page-navi meta"> 
	<?php 
		if( get_next_posts_link() ){
			echo '<div class="prev">'. get_next_posts_link('<i class="budicon-arrow-left-1"></i> '. esc_html__('Older Posts', 'malefic')) .'</div>';
		}
			
		if( get_previous_posts_link() ){
			echo '<div class="next">'. get_previous_posts_link(esc_html__('Newer Posts', 'malefic') .' <i class="budicon-arrow-right-1"></i>') .'</div>';
		}
	?>
</div>