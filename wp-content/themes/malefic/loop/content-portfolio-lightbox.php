<?php 
	if(!( has_post_thumbnail() ))
		return false;
		
	$src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); 
?>

<div class="cbp-item <?php echo ebor_the_terms('portfolio_category', ' ', 'slug'); ?>">
	<a href="<?php echo $src[0]; ?>" class="cbp-caption lgitem" data-sub-html="#caption<?php the_ID(); ?>">
	
		<div class="cbp-caption-defaultWrap"> 
			<?php the_post_thumbnail('large'); ?>
		</div>
		
		<div class="cbp-caption-activeWrap">
			<div class="cbp-l-caption-alignCenter">
				<div class="cbp-l-caption-body">
					<?php the_title('<p>', '</p>'); ?>
				</div>
			</div>
		</div>
		
		<div id="caption<?php the_ID(); ?>" class="hidden">
			<?php the_content(); ?>
		</div>
	
	</a> 
</div>