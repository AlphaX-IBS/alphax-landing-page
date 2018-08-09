<?php
	if(!( has_post_thumbnail() ))
		return false;
?>

<figure>
	<?php the_post_thumbnail('large'); ?>
</figure>